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
                    <a href='./login.php'>Sign In</a>
                </nav>
            </header>
            <form class='register' method='post'>
                <h3>Register</h3>
                <br/>
                <div>
                    <label htmlFor='firstname'>First Name:</label><br/>
                    <input type='text' name='firstname'/>
                </div>
                <br/>
                <div>
                    <label htmlFor='lastname'>Last Name:</label><br/>
                    <input type='text' name='lastname'/>
                </div>
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
                <button name='submit'>Register</button>
            </form>
        </body>
    </html>
    ";
?>
<?php 
    include 'config.php';

    if(!empty($_POST['firstname']) && 
    !empty($_POST['lastname']) && 
    !empty($_POST['email']) &&
    !empty($_POST['password'])) 
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $username = substr(strtolower($firstname), 0, 1) . strtolower($lastname) . sprintf('%03s', strval(rand(1, 999)));
        $password = $_POST['password'];
        $hash = password_hash($password, PASSWORD_BCRYPT, [ "cost" => 15 ]);
        $sql = "INSERT INTO `users`(`first_name`, `last_name`, `email`, `username`, `user_password`, `registration_date`) 
        VALUES ('$firstname','$lastname','$email','$username', '$hash', NOW())";
        $result = $conn->query($sql);

        if ($result == TRUE) {
            echo "<br/><p style='color: white; text-align: center'>You have successfully registered! You may log in now.</p>";
        }
        else{
            $db_error = strval($conn->error);
            echo "Error:". $sql . "<br>". $db_error;
            echo "<br/><p style='color: white; text-align: center'>Email is taken!</p>";
        }
    
        $conn->close();
    }
    else { 
        echo "<br/><p style='color: white; text-align: center'>Fill in every field.</p>";
    }
?>