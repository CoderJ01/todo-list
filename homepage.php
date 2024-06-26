<?php
    include 'config.php'; // connect to database

    if(!isset($_COOKIE['todo-cookie'])) {
        echo "<script>window.location='" . $domain . "/register.php'</script>";
    }

    // delete a task
    if(isset($_GET['id'])) {
        $id = $_GET['id']; // retrieve id from the URL
        $sql_delete_task = "DELETE FROM `tasks` WHERE task_id = $id";
        mysqli_query($db, $sql_delete_task);    
    }

    // get the user associated with the cookie
    $cookie = $_COOKIE["todo-cookie"];
    $sql_get_username = "SELECT * FROM `users` WHERE user_cookie = '$cookie'";
    $result = mysqli_query($db, $sql_get_username);

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
                <nav>
                    <text class='logout'>Logout</text>
                </nav>
            </header>
            <section class='homepage'>
                <div class='todo-list'>
                    <h2>Your Tasks</h2>";
                    $sql_get_tasks = "SELECT * FROM `tasks` WHERE user_id = '$user_id'";
                    $result = mysqli_query($db, $sql_get_tasks);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $task = $row["task"];
                            echo"
                            <div class='task'>
                                <div>
                                    <span class='check'>&#10003;</span>
                                    <text>$task</text>
                                </div>
                                <span class='remove'><a href='" . $domain . "/homepage.php?id=" . $row["task_id"] ."'>&#9447;</a></span>
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
        $task = strip_tags($_POST['task']);
        $protected_task = mysqli_real_escape_string($db, $task); // protection from SQL injection attack

        // check for duplicate entries
        $sql_check_for_duplicate = "SELECT * FROM tasks WHERE task = '$protected_task' AND user_id = $user_id";
        $duplicate = mysqli_query($db, $sql_check_for_duplicate);

        if ($duplicate->num_rows <= 0) {
            // store task into database
            $sql = "INSERT INTO `tasks`(`task`, `task_created_at`, `user_id`) 
            VALUES ('$protected_task', NOW(),'$user_id')";
            $result = mysqli_query($db, $sql);

            if($result == TRUE) {
                echo "<script>location.reload()</script>";
            }
        } 
    }
?>