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
                    <input type='text' name='firstname' value='Enter input'/>
                </div>
                <br/>
                <div>
                    <label htmlFor='lastname'>Last Name:</label><br/>
                    <input type='text' name='lastname' value='Enter input'/>
                </div>
                <br/>
                <div>
                    <label htmlFor='email'>Email:</label><br/>
                    <input type='email' name='email' value='Enter input'/>
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
        echo "<p style='color: white;'>Name: $firstname $lastname</p>";
        echo "<p style='color: white;'>Email: $email</p>";
        echo "<p style='color: white;'>Username: $username</p>";
        echo "<p style='color: white;'>Password: $password</p>";

        // logic for SQL database will go here for Project Deliverable 3
    }
    else { 
        echo "<p style='color: white;'>Enter all inputs</p>";
    }
?>