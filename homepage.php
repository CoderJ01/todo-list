<?php
    include 'config.php'; // connect to database

    // delete a task
    if(isset($_GET['id'])) {
        $id = $_GET['id']; // retrieve id from the URL
        $sql_delete_task = "DELETE FROM `tasks` WHERE task_id = $id";
        $conn->query($sql_delete_task);    
    }

    // get the user associated with the cookie
    $cookie = $_COOKIE["todo-cookie"];
    $sql_get_username = "SELECT * FROM `users` WHERE user_cookie = '$cookie'";
    $result = $conn->query($sql_get_username);

    $user_id = '';

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
           $user_id = $row["user_id"]; // find the user's id
        }
    } 

    echo "
    <!DOCTYPE html>
    <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <link rel='stylesheet' href='../assets/css/header.css'/>
            <link rel='stylesheet' href='../assets/css/homepage.css'/>
            <title>Todo List</title>
        </head>
        <body>
            <header>
                <h1><a href='./homepage.php'>Todo List</a></h1>
                <nav>";
                if(!isset($_COOKIE['todo-cookie'])) {
                    header("Location: http://localhost:3000/register.php");
                }
                else {
                    echo"
                    <text class='logout'>Logout</text>
                    ";
                }
                echo
                "</nav>
            </header>
            <section class='homepage'>
                <div class='todo-list'>
                    <h2>Your Tasks</h2>";
                    $sql_get_tasks = "SELECT * FROM `tasks` WHERE user_id = '$user_id'";
                    $result = $conn->query($sql_get_tasks);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $task = $row["task"];
                            echo"
                            <div class='task'>
                                <div>
                                    <span class='check'>&#10003;</span>
                                    <text>$task</text>
                                </div>
                                <span class='remove'><a href='http://localhost:3000/homepage.php?id=" . $row["task_id"] ."'>&#9447;</a></span>
                            </div>";
                        }
                    } 
                echo"
                </div>
                <div class='activate-popup'>
                    <button id='myBtn'>+</button>
                </div>
                <div id='myModal' class='modal'>
                    <div class='modal-content'>
                        <span class='close'>&times;</span>
                        <form method='post'>
                            <h3>Input Task</h3>
                            <br/>
                            <div>
                                <label htmlFor='task'>Task:</label><br/>
                                <input type='text' name='task'/>
                            </div>
                            <button name='submit'>Submit Task</button>
                        </form>
                    </div>
                </div>
            </section>
        </body>
    </html>
    <script type='text/javascript' src='./assets/js/homepage.js'></script>
    ";

    if(!empty($_POST['task'])) {
        $task = $_POST['task'];

        // store task into database
        $sql = "INSERT INTO `tasks`(`task`, `task_created_at`, `user_id`) 
        VALUES ('$task', NOW(),'$user_id')";
        $result = $conn->query($sql);

        $conn->close();

        header("Refresh:0"); // refresh the page
    }
?>