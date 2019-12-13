<?php 

include 'functions.php';

function form_sanitizion_and_validation() 
{
    $arr_sanitizers = [
        'task_to_add' => FILTER_SANITIZE_STRING
    ];

    $arr_validation_filters = [
        'task_to_add' => FILTER_VALIDATE_REGEXP
    ];

    $arr_regexp = [
        'task_to_add' => '/[\w\W]{2,200}/'
    ];

    $arr_errors = [
        'task_to_add' => null
    ];

    $sanitized_form = filter_input_array(INPUT_POST, $arr_sanitizers);

    $is_form_valid = true;

    foreach ($sanitized_form as $key => $value) {

        $sanitized_form[$key] = trim($value);

        $options = [
            'options' => [
                'regexp' => $arr_regexp[$key]
            ]
        ];

        if (!filter_var($value, $arr_validation_filters[$key], $options)) {

            $arr_errors[$key] = "Invalid field";
            $is_form_valid = false;
            echo "false ";

        } else {
            
            echo "true ";

        }
    }

    if ($is_form_valid) {

        echo "alright ";

        foreach ($arr_errors as $key => $values) {
            $arr_errors[$key] == null;
        }

        return $sanitized_form;
        
    } else {

        echo "check your content ";

    }
}

function encode_to_json() {
    
    $json_file = "../json/todo.json";

    // gets the data after sanitization and validation
    $arr_data = form_sanitizion_and_validation();
    // gets the first (and only) value of the array
    $data = array_values($arr_data)[0];
    // gets the data from the todo.json
    $old_json_data = get_json_data($json_file, true);
    // pushes the data into the json we just got
    array_push($old_json_data['todo'], $data);
    // encodes a new json object based on the new data
    $new_json_data = json_encode($old_json_data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    // sends the new json object in the targeted file
    file_put_contents($json_file, $new_json_data);
}



echo '<pre>';
encode_to_json();