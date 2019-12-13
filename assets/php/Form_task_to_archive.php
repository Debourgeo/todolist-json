<?php

include 'functions.php';

$a = filter_input_array(INPUT_POST);

echo '<pre>';
print_r($a);

// il faut faire une array à la sanitize submit
