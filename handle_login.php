<!doctype html>
<html lang='en'>
    <head>
        <meta charset='utf-8'>
        <title>Registration Form Feedback</title>
    </head>
    <body>
    <?php 
        if(!empty($_POST['email']) && !empty($_POST['password'])) 
        {
            echo "<p> Email: {$_POST['email']}";
            echo "<p> Password: {$_POST['password']}";
        }
        else { 
            echo '<p>Please go back and fill out the form again.</p>';
        }
    ?>
    </body>
</html>
