<?php 
    include 'config.php';

    $protected_email = mysqli_real_escape_string($db, strip_tags($_POST['email']));

    // cookie data
    $cookie_name = 'todo-cookie';
    $cookie_value =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 80); // random string
    $hashed_cookie = password_hash($cookie_value, PASSWORD_BCRYPT, [ "cost" => 15 ]);

    // set cookie
    setcookie($cookie_name, $hashed_cookie, time() + (86400 * 30), '/');

    $sql = "UPDATE `users` SET user_cookie = '$hashed_cookie' WHERE email='$protected_email'";
    $result = mysqli_query($db, $sql);
    echo "<script>window.location='" . $domain . "/homepage.php'</script>";
?>