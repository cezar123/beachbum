<?php
require __DIR__.'/../vendor/autoload.php';

$rules = [
    'task' => FILTER_SANITIZE_ENCODED,
    'controller' => FILTER_SANITIZE_ENCODED,
    'method' => FILTER_SANITIZE_ENCODED
];

$inputs = filter_var_array(INPUT_POST, $rules);

var_dump($inputs);

$controller = new $inputs['controller']();
$controller->{$inputs['method']}();

?>