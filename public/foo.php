<?php
error_reporting(-1);
ini_set('display_errors', 'On');

$params = [
    'id' => 1,
    'string' => 'hello'
];

function foo($id, $string) {
    echo $id."<br>";
    echo $string;
}

foo(...$params);