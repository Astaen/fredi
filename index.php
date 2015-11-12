<?php
session_start();
require 'vendor/autoload.php';

include("models/User.php");
include("models/Note.php");
include("models/Fee.php");

//Instance de Slim
$app = new \Slim\Slim();


$app->get('/', function () {
    echo "Page d'accueil";
});

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

$app->run();

?>
