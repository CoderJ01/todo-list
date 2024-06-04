<?php
    include 'config.php';

    // redirect user to login page after invalid input
    function redirect($message, $seconds, $domain) {
        $style = "style='color: white; text-align: center; font-size: 25px'";
        echo "
        <br/>
        <body style='background-color: rgb(32, 43, 62);'>
            <p $style>$message</p>
            <p $style>You will be redirected to the login page in <span id='counter'>$seconds<span></p>
        </body>";
        echo "<script>window.setTimeout(function(){ window.location.href = '" . $domain ."/login.php'; }, ($seconds * 1000));</script>";
        echo "
        <script type='text/javascript'>
            function countdown() {
                var i = document.getElementById('counter');
                if (parseInt(i.innerHTML) <= 0) {
                    location.href = 'login.php';
                }
                if (parseInt(i.innerHTML)!=0) {
                    i.innerHTML = parseInt(i.innerHTML) - 1;
                }
            }
            setInterval(function(){ countdown(); }, 1000);
        </script>
        ";
    }

    if(!empty($_POST['email']) && !empty($_POST['password'])) {
        // user inputs
        $email = strip_tags($_POST['email']); // strip_tags() protect against XSS attacks
        $password = strip_tags($_POST['password']);

        // protect from SQL injection attack
        $protected_email = mysqli_real_escape_string($db, $email);
        $protected_password = mysqli_real_escape_string($db, $password);

        // get all users' emails from todo.users table
        $sql_get_emails = "SELECT email FROM `users`";
        $result = mysqli_query($db, $sql_get_emails);
  
        if ($result->num_rows > 0) {
            $match = false;
            while($row = $result->fetch_assoc()) {
                if($row["email"] === $email) {
                    $match = true; // email exists in the database
                }
            }
            if($match == true) {
                $correct_password = false;

                // get password associated with email
                $sql_get_user_password = "SELECT user_password FROM `users` WHERE email='$protected_email'";
                $result = mysqli_query($db, $sql_get_user_password);

                while($row = $result->fetch_assoc()) {
                    // verify that user input the correct password
                    if(password_verify($protected_password, $row["user_password"])) {
                        $correct_password = true; // password matches w/ email
                    }
                }
                if($correct_password === true) {
                    // cookie data
                    $cookie_name = 'todo-cookie';
                    $cookie_value =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 80); // random string
                    $hashed_cookie = password_hash($cookie_value, PASSWORD_BCRYPT, [ "cost" => 15 ]);

                    // set cookie
                    setcookie($cookie_name, $hashed_cookie, time() + (86400 * 30), '/');

                    $sql = "UPDATE `users` SET user_cookie = '$hashed_cookie' WHERE email='$protected_email'";
                    $result = mysqli_query($db, $sql);
                    echo "<script>window.location='" . $domain . "/homepage.php'</script>";
                }
                else {
                    redirect("The password does not match the email!", 3, $domain);
                }
            }
            else {
                redirect("This email has yet to be registered!", 3, $domain);
            }
        }
        else{
            // $db_error = strval($conn->error);
            // echo "Error:". $sql . "<br>". $db_error;
        }
    }
    else { 
        redirect("Fill in every field!", 3, $domain);
    } 
?>