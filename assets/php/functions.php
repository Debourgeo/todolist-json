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

    if ($name_of_data_to_display == "todo") {
        $class = "todo";
    } else {
        $class = "done";
    }
    // Display the data
    foreach ($wanted_data as $key => $value) {
        echo "<li>" . "<input type='checkbox' name='$key' id='$class$key' class='$class' />" . "<label>" . "$value" . "</label>" . "</li>";
    }
}

function form_sanitizion_and_validation()
{
    $arr_sanitizers = [
        'task_to_add' => FILTER_SANITIZE_STRING,
    ];

    $arr_validation_filters = [
        'task_to_add' => FILTER_VALIDATE_REGEXP,
    ];

    $arr_regexp = [
        'task_to_add' => '/[\w\W]{2,200}/',
    ];

    $arr_errors = [
        'task_to_add' => null,
    ];

    $sanitized_form = filter_input_array(INPUT_POST, $arr_sanitizers);

    $is_form_valid = true;

    foreach ($sanitized_form as $key => $value) {

        $sanitized_form[$key] = trim($value);

        $options = [
            'options' => [
                'regexp' => $arr_regexp[$key],
            ],
        ];

        if (!filter_var($value, $arr_validation_filters[$key], $options)) {

            $arr_errors[$key] = "Invalid field";
            $is_form_valid = false;

        }
    }

    if ($is_form_valid) {

        foreach ($arr_errors as $key => $values) {
            $arr_errors[$key] == null;
        }

        return $sanitized_form;

    } else {

        echo "check your content ";

    }
}

function add_task_to_json($data, $task = "todo")
{
    // $data = something to push in the json
    // $task should be "done" or "todo"

    $json_file = "../json/todo.json";

    // gets the data from the todo.json
    $old_json_data = get_json_data($json_file, true);
    // pushes the data into the json we just got
    array_push($old_json_data[$task], $data);

    // encodes a new json object based on the new data
    $new_json_data = json_encode($old_json_data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    // in the targeted file, erase the old json content by the new json object
    file_put_contents($json_file, $new_json_data);
}

function redirect($url)
{
    ob_start();
    header('Location: ' . $url);
    ob_end_flush();
    exit();
}
