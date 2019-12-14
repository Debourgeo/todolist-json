<?php

include 'functions.php';

$new_task = form_sanitizion_and_validation(); // form_sanitizion_and_validation gives an array
$new_task = $new_task["task_to_add"];

add_task_to_json($new_task, "todo");

redirect('../../content.php');
