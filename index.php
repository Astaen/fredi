<?php
session_start();

ini_set('xdebug.var_display_max_depth', 5);
ini_set('xdebug.var_display_max_children', 999);
ini_set('xdebug.var_display_max_data', 9999);

require 'vendor/autoload.php';

//importation des fonctions de
require("class/bdd.php");
require("class/fredi.php");

//importation des modèles
require("models/Club.php");
require("models/User.php");
require("models/Member.php");
require("models/Note.php");
require("models/Fee.php");

//instanciation de slim
$app = new \Slim\Slim();

$app->setName('FREDI');

$app->config(array(
	'templates.path' => './views'
));

$app->hook('slim.before.dispatch', function() use ($app) { 
   $public = array('login');

	if(!in_array('login', (array)$app->router()->getCurrentRoute())) {
		if(!isset($_SESSION['logged'])) {
			// var_dump($app->router()->getCurrentRoute());
			$app->redirect('/login');
		}
	}
});

$app->get('/', function() use($app) {
	if(isset($_SESSION['logged'])) {
		$note = new Note();
		$notes = $note->fetchAll(2);
		$fee = new Fee();
		foreach ($notes as $key => $note) {
			$fees = $fee->fetchAll($note->id_note);
			$note->fees = $fees;
		}
		$app->render('user/main.php', array('notes' => $notes, 'member' => $_SESSION['userinfo']));
	} else {
		$app->redirect('/login');
	}
});

/* CUSTOM ROUTES */
require 'routes/login.php';
require 'routes/notes.php';

$app->render('header.php', Array('title' => $app->getName()));
$app->run();
$app->render('footer.php');
?>
