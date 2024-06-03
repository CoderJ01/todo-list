<?php
    echo "
    <!DOCTYPE html>
    <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <link rel='stylesheet' href='../assets/css/header.css'/>
            <link rel='stylesheet' href='./assets/css/regsiter.css'/>
            <title>Todo List</title>
        </head>
        <body>
            <header>
                <h1><a href='./homepage.php'>Todo List</a></h1>
                <nav>
                    <a href='./register.php'>Register</a>
                </nav>
            </header>
            <form class='register' method='post'>
                <h3>Login</h3>
                <br/>
                <div>
                    <label htmlFor='email'>Email:</label><br/>
                    <input type='email' name='email'/>
                </div>
                <br/>
                <div>
                    <label htmlFor='password'>Password:</label><br/>
                    <input type='password' name='password'/>
                </div>
                <br/>
                <button name='submit'>Login</button>
            </form>
        </body>
    </html>
    ";
?>
<?php
    include 'config.php';

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
                    echo "<br/><p style='color: white; text-align: center'>You have successfully logged in!</p>";

                    // cookie data
                    $cookie_name = 'todo-cookie';
                    $cookie_value =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 80); // random string
                    $hashed_cookie = password_hash($cookie_value, PASSWORD_BCRYPT, [ "cost" => 15 ]);

                    // set cookie
                    setcookie($cookie_name, $hashed_cookie, time() + (86400 * 30), '/');

                    $sql = "UPDATE `users` SET user_cookie = '$hashed_cookie' WHERE email='$protected_email'";
                    $result = mysqli_query($db, $sql);
                    // $conn->close();
                    echo "<script>window.location='http://localhost:3000/homepage.php'</script>";
                }
                else {
                    echo "<br/><p style='color: white; text-align: center'>The password does not match the email!</p>";
                }
            }
            else {
                echo "<br/><p style='color: white; text-align: center'>This email has yet to be registered!</p>";
            }
        }
        else{
            // $db_error = strval($conn->error);
            // echo "Error:". $sql . "<br>". $db_error;
        }
    }
    else { 
        echo "<br/><p style='color: white; text-align: center'>Fill in every field.</p>";
    } 
?>