<?php
    // The three tasks currently listed is merely dummy data. Once this file is connected to 
    // a SQL database, the tasks will be retrived from SQL and rendered dynamically based 
    // on the logged in user 
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
                    echo"
                    <a href='/register.php'>Register</a>
                    <a href='/login.php'>Sign In</a>
                    ";
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
                    <h2>Your Tasks</h2>
                    <div class='task'>
                        <div>
                            <span class='check'>&#10003;</span>
                            <text>This is a task!</text>
                        </div>
                        <span class='remove'>&#9447;</span>
                    </div>
                    <div class='task'>
                        <div>
                            <span class='check'>&#10003;</span>
                            <text>This is a task!</text>
                        </div>
                        <span class='remove'>&#9447;</span>
                    </div>
                    <div class='task'>
                        <div>
                            <span class='check'>&#10003;</span>
                            <text>This is a task!</text>
                        </div>
                        <span class='remove'>&#9447;</span>
                    </div>
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
                                <input type='text' name='task' value='Enter a task here...'/>
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
?>
<?php 
    if(!empty($_POST['task']) && $_POST['task'] !== "Enter a task here...") {
        $task = $_POST['task'];
        echo "<p style='color: white;'>Task: $task</p>";
        
        // logic for SQL database will go here for Project Deliverable 3
    }
    else { 
        echo "<p style='color: white;'>No task entered</p>";
    }
?>