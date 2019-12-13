<?php

include 'functions.php';

$new_task = form_sanitizion_and_validation(); // form_sanitizion_and_validation gives an array
$new_task = $new_task["task_to_add"];

echo '<pre>';
echo "ça marche d'écrire";
print_r($new_task);

encode_to_json($new_task, "todo");
