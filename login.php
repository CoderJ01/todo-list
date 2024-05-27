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
        $email = $_POST['email'];
        $password = $_POST['password'];
        echo "<p style='color: white;'>Email: $email</p>";
        echo "<p style='color: white;'>Password: $password</p>";
        // logic for SQL database will go here for Project Deliverable 3
        $sql_get_emails = "SELECT email FROM `users`";
        $result = $conn->query($sql_get_emails);
  
        if ($result->num_rows > 0) {
            $match = false;
            while($row = $result->fetch_assoc()) {
                if($row["email"] === $email) {
                    $match = true;
                }
            }
            if($match == true) {
              
            }
            else {
                echo "<br/><p style='color: white; text-align: center'>This email has yet to be registered!</p>";
            }
        }
        else{
            $db_error = strval($conn->error);
            echo "Error:". $sql . "<br>". $db_error;
        }
    
        $conn->close();
    }
    else { 
        echo "<br/><p style='color: white; text-align: center'>Fill in every field.</p>";
    } 
?>