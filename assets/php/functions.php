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
        echo "<li id='$class$key' class='li dropable' draggable='true' ondragstart='onDragStart(event);'>" . "<input type='checkbox' name='$key' id='$class$key' class='$class' />" . "<label class='label dropable'>" . "$value" . "</label>" . "</li>";
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

// echo '<pre>';
// list_of_todo_or_done('todo');
// list_of_todo_or_done('done');
