<?php
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database_name = ''; 
    $conn = new mysqli($server, $username, $password, $database_name);

    if($conn->connect_error) {
        die("Connection Failed" . $conn->connect_error);
    }
?>