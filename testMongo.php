<?php

require_once './vendor/autoload.php';

$client = new MongoDB\Client(
    'mongodb://root:ChangeMe@mongo/test?retryWrites=true&w=majority'
);
$db = $client->test;

var_dump($db);
