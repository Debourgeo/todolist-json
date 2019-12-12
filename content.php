<?php
include 'assets/php/header.php';
include 'assets/php/functions.php';
?>

    <h1>To Do List</h1>
    <h2>To Do:</h2>
    <ul>
        <!--
        forme de l'output:
        <input type="checkbox" name="task#X"/>
        <label>La tâche</label>
        -->
        <!-- /* Call here the function for the "to do list" */ -->
        <?php echo_list_of_todo();?>
    </ul>
    <h2>Done:</h2>
    <ul>
        <?php
/* Call here the function for the "done list" */
?>
        <?php echo_list_of_done();?>
    </ul>
    <h2>Add a task:</h2>
    <form action="assets/php/form.php" method="post">
        <textarea name="task_to_add" placeholder="Your task to add" id="task_to_add" cols="30" rows="10"></textarea>
        <button id="submit">add the task</button>
    </form>

    <script src="assets/js/script.js"></script>
    <?php
include 'assets/php/footer.php';
?>