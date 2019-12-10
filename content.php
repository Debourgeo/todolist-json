<?php
include 'assets/php/header.php';
include 'assets/php/functions.php';
?>

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
    <form action="assets/php/form.php" method="post">
    <input type="text" placeholder="Your task to add" name="task_to_add" value="">
    <button id="submit">add the task</button>
    </form>

    <?php
include 'assets/php/footer.php';
?>