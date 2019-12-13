<?php

include 'functions.php';

$array = filter_input_array(INPUT_POST);

$array_of_keys = array_keys($array, 'on');
$array_of_keys = array_reverse($array_of_keys);

echo '<pre>';
print_r($array_of_keys);
// print_r($array);

$json_file = "../json/todo.json";
$json_data = get_json_data($json_file, true);

foreach ($array_of_keys as $key => $value) {
    array_unshift($json_data['done'], $json_data['todo'][$value]);
    unset($json_data['todo'][$value]);
}

$json_data['todo'] = array_values($json_data['todo']);

// encodes a new json object based on the new data
$updated_json_data = json_encode($json_data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

// in the targeted file, erase the old json content by the new json object
file_put_contents($json_file, $updated_json_data);

redirect('../../content.php');
