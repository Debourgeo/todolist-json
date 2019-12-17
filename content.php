<?php
include 'assets/php/header.php';
include 'assets/php/functions.php';
?>
    <div class="container">

        <h1>To Do List</h1>
        <h2>To Do:</h2>
        <form id="checkBoxForm" action="assets/php/Form_task_to_archive.php" method="post">
            <ul class="pt-3 ul dropable" ondragover='onDragOver(event);' ondrop='onDrop(event);'>
                <?php list_of_todo_or_done('todo');?>
                <!--
                forme de l'output:
                <li>
                <input type="checkbox" name="task#X"/>
                <label>La tâche</label>
                </li>
                -->
            </ul>
        </form>
        <h2>Done:</h2>
        <form id="doneForm" action="assets/php/Form_task_to_archive.php" method="post">
            <ul class="pt-3 ul dropable" ondragover='onDragOver(event);' ondrop='onDrop(event);'>
                <?php list_of_todo_or_done('done');?>
            </ul>
        </form>
        <h2>Add a task:</h2>
        <form action="assets/php/Form_add_task.php" method="post">
            <textarea ondrop="return false;" name="task_to_add" placeholder="Your task to add" id="task_to_add" cols="30" rows="10"></textarea>
            <button id="submit_add_task">add the task</button>
        </form>
    </div>
    <script src="assets/js/script.js"></script>
    <?php
include 'assets/php/footer.php';
?>