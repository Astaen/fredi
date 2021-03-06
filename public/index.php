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
	'templates.path' => './views'
));

$app->get('/login', function() use($app) {
	echo "connard";
	// $app->render('login.php');
});

$app->get('/', function() use($app) {
	$note = new Note();
	$notes = $note->fetchAll(2);	
	$app->render('user/main.php', array('notes' => $notes));
});


$app->get('/hello/', function() {
    echo "Hello, world!";
});

$app->render('header.php');
$app->run();
$app->render('footer.php');
?>
