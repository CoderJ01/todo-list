<!doctype html>
<html lang='en'>
    <head>
        <meta charset='utf-8'>
        <title>Task Form Feedback</title>
    </head>
    <body>
    <?php 
        if(!empty($_POST['task'])) {
            echo "<p> Task: {$_POST['task']}";
        }
        else { 
            echo '<p>Please go back and fill out the form again.</p>';
        }
    ?>
    </body>
</html>
