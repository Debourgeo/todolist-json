<?php
include 'functions.php';

$data = form_sanitizion_and_validation();

if (!empty($data)) {
    $json_file = "../json/todo.json";
    $json_data = get_json_data($json_file, true);
    $old_ID = $data['oldID'];
    $new_ID = $data['newID'];
    // extract position in JSON
    preg_match('/todo|done/', $old_ID, $old_Name_List);
    preg_match('/todo|done/', $new_ID, $new_Name_List);
    preg_match('/\d+/', $old_ID, $oldPosition);
    preg_match('/\d+/', $new_ID, $newPosition);
    $oldPosition = $oldPosition[0];
    $newPosition = $newPosition[0];
    $toMove = array_splice($json_data[$old_Name_List[0]], $oldPosition, 1);
    array_splice($json_data[$new_Name_List[0]], $newPosition, 0, $toMove);
    $updated_json_data = json_encode($json_data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    file_put_contents($json_file, $updated_json_data);
}
redirect('../../content.php');
