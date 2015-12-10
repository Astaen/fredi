<?php
ini_set('xdebug.var_display_max_depth', 5);
ini_set('xdebug.var_display_max_children', 999);
ini_set('xdebug.var_display_max_data', 9999);

// require './vendor/fpdf/fpdf.php';
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

//importation des fonctions de
require("class/bdd.php");
require("class/fredi.php");

//importation des modèles
require("models/Club.php");
require("models/User.php");
require("models/Member.php");
require("models/Note.php");
require("models/Fee.php");

session_start();

$app = new \Slim\Slim();

$app->setName('FREDI');

$app->config(array(
	'templates.path' => './views'
));

//Protection des routes
$app->hook('slim.before.dispatch', function () use($app) {
	$accessible = Array('login', 'about'); //Ces routes ne nécessitent pas d'être authentifié
	if(!isset($_SESSION['logged'])) {
		if(!in_array($app->router->getCurrentRoute()->getName(), $accessible)) {
			$app->redirect('login');
		}
	}
});

$app->get('/', function() use($app) {
	if(isset($_SESSION['logged'])) {
		$note = new Note();
		$notes = $note->fetchAll($_SESSION['userinfo']->id_user);
		$app->render('user/main.php', array('notes' => $notes, 'user' => $_SESSION['userinfo']));
	} else {
		$app->redirect('/login');
	}
});

//Custom routes
require 'routes/login.php';
require 'routes/notes.php';
require 'routes/fees.php';
require 'routes/misc.php';

//Configurer les routes qui n'ont pas de header
$app->hook('slim.before.dispatch', function () use($app) {
	$no_header = Array(); //Ces routes ne nécessitent pas de rendre le headers
	if(!in_array($app->router->getCurrentRoute()->getName(), $no_header)) {
		$app->render('header.php', Array('title' => $app->getName()));
	}
});

//Configurer les routes qui n'ont pas de footer
$app->hook('slim.after.dispatch', function () use($app) {
	$no_footer = Array(); //Ces riytes ne nécessitent pas de rendre le footer
	if(!in_array($app->router->getCurrentRoute()->getName(), $no_footer)) {
		$app->render('footer.php');
	}
});

$app->run();

?>
