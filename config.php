<?php
    $db_server = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'todo'; 

    $db = new mysqli ($db_server, $db_username, $db_password, $db_name);

    if(mysqli_connect_errno()) {
        die('Connection Failed: ' . mysqli_connect_error());
    }
?>