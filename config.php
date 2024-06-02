<?php
    $db_server = 'localhost';
    $db_name = 'todo';
    $db_username = 'root';
    $db_password = ''; 

    try {
        $db = new PDO("mysql:host=$db_server;dbname=$db_name", $db_username, $db_password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } 
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>