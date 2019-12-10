<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To Do list</title>
    <meta name="description" content="Brice & Denis' To Do list for BeCode">
</head>
<body>
    <h1>To Do List</h1>
    <h2>To Do:</h2>
    <ul>
        <?php
/* Call here the function for the "to do list" */
?>
    </ul>
    <h2>Done:</h2>
    <ul>
        <?php
/* Call here the function for the "done list" */
?>
    </ul>
    <h2>Add a task:</h2>
    <form action="" method="post">
    <input type="text" placeholder="Your task to add" name="task_to_add" value="">
    <button id="submit">add the task</button>
    </form>
</body>
</html>