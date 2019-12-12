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
    
    $array_data = form_sanitizion_and_validation();
    $data = array_key_first($array_data);
    echo $data;

    $json_data = json_encode($data, JSON_UNESCAPED_UNICODE);
    file_put_contents("../json/todo.json", $json_data);
}

encode_to_json();