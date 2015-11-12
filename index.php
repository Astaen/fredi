<?php
session_start();
require 'vendor/autoload.php';

//importation des fonctions de
require("class/fredi.php");

//importation des modèles
require("models/User.php");
require("models/Note.php");
require("models/Fee.php");

//instanciation de slim
$app = new \Slim\Slim();

$app->config(array(
	'templates.path' => '../views'
));

$app->get('/', function() {
	echo "toutes les notes";
	$note = new Note();
	var_dump($note->fetchAll(2, "2014"));
});

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

$app->run();

?>
