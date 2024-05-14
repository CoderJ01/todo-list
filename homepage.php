<?php
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
                    <a href='/register.php'>Register</a>
                    <a href='/login.php'>Sign In</a>
                </nav>
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
                        <form action='handle_task.php' method='post'>
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
?>