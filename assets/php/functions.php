<?php

function get_json_data($path_to_json, $convert_object_to_array = true)
{
    // this function gets all the data from the json in one string
    $str = file_get_contents($path_to_json);
    // This function decode the json string to get an object.
    // The true parameter is to convert all object into an associative array.
    // Having an associativ array is usefull to iterate over it.
    $data = json_decode($str, $convert_object_to_array);
    return $data;
}

function list_of_todo_or_done($name_of_data_to_display)
{
    // The value of $name_of_data_to_display should be "todo" or "done"

    // Read the data
    $data = get_json_data('assets/json/todo.json', true);
    // Get the part of the data that we want
    $wanted_data = $data["$name_of_data_to_display"];

    // Display the data
    foreach ($wanted_data as $key => $value) {
        echo "<input type='checkbox' name='task#X'/>" . "<li>" . "$value" . "</li>";
    }
}

// echo '<pre>';
// list_of_todo_or_done('todo');
// list_of_todo_or_done('done');
