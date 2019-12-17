<?php
include 'functions.php';

$data = form_sanitizion_and_validation();

if (!empty($data)) {
    $json_file = "../json/todo.json";
    $json_data = get_json_data($json_file, true);
    $oldID = $data['oldID'];
    $newID = $data['newID'];
    // extract position in JSON
    preg_match('/todo|done/', $oldID, $oldList);
    preg_match('/todo|done/', $newID, $newList);
    preg_match('/\d+/', $oldID, $oldPosition);
    preg_match('/\d+/', $newID, $newPosition);
    $toMove = array_splice($json_data[$oldList], $oldPosition, 1);
    array_splice($json_data[$newList], $newPosition, 0, $toMove);
    $updated_json_data = json_encode($json_data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    file_put_contents($json_file, $updated_json_data);
}
redirect('../../content.php');
