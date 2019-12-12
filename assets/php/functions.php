<?php

function echo_list_of_todo()
{
    // Read the data of todo

    // loop to echo the data of todo

}

function echo_list_of_done()
{
    // Read the data of Done

    // this function gets all the data from the json in one string
    $str = file_get_contents('../json/todo.json');

    // This function decode the json string to get an object.
    // The true parameter is to convert all object into an associative array.
    // Having an associativ array is usefull to iterate over it.
    $data = json_decode($str, true);

    // loop to echo the data of Done

}

echo_list_of_done();
