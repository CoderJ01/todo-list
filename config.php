<?php
    $db_server = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'todo'; 

    $db = new mysqli ($db_server, $db_username, $db_password, $db_name);
    $domain = "http://localhost:3000";

    if(mysqli_connect_errno()) {
        die('Connection Failed: ' . mysqli_connect_error());
    }
?>