<?php
    include 'config.php'; // connect to SQL database

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
    
    if(!empty($_POST['firstname']) && 
    !empty($_POST['lastname']) && 
    !empty($_POST['email']) &&
    !empty($_POST['password'])) 
    {
        // password validation 
        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
        if(!preg_match($pattern, $_POST['password'])) {
            echo "<br/><p style='color: white; text-align: center'>The password must have a minimum of eight characters. It must also have at least one uppercase letter, one lowercase letter, one number and one special character.</p>";
            return;
        }

        // user inputs
        $firstname = strip_tags($_POST['firstname']);
        $lastname = strip_tags($_POST['lastname']);
        $email = strip_tags($_POST['email']);
        $username = substr(strtolower($firstname), 0, 1) . strtolower($lastname) . sprintf('%03s', strval(rand(1, 999)));
        $password = strip_tags($_POST['password']);

        // protect from SQL injection attack
        $protected_firstname = mysqli_real_escape_string($db, $firstname);
        $protected_lastname = mysqli_real_escape_string($db, $lastname);
        $protected_email = mysqli_real_escape_string($db, $email);
        $protected_password = mysqli_real_escape_string($db, $password);
        
        // hash password 
        $hash = password_hash($protected_password, PASSWORD_BCRYPT, [ "cost" => 15 ]);
        
        // insert input into database
        $sql = "INSERT INTO `users`(`first_name`, `last_name`, `email`, `username`, `user_password`, `registration_date`) 
        VALUES ('$protected_firstname','$protected_lastname','$protected_email','$username', '$hash', NOW())";
        $result = mysqli_query($db, $sql);

        if ($result == TRUE) {
            // display success message
            echo "<br/><p style='color: white; text-align: center'>You have successfully registered! You may log in now.</p>";
        }
        else{
            // $db_error = strval($conn->error);
            // echo "Error:". $sql . "<br>". $db_error;
            echo "<br/><p style='color: white; text-align: center'>Email is taken!</p>";
        }
    }
    else { 
        echo "<br/><p style='color: white; text-align: center'>Fill in every field.</p>";
    }
?>