<?php
session_start();

ini_set('xdebug.var_display_max_depth', 5);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

require 'vendor/autoload.php';

//importation des fonctions de
require("class/bdd.php");
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

/*=============================
=            Login            =
=============================*/

$app->get('/login', function() use($app) {
	$app->render('login.php');
});

$app->post('/login', function() use($app) {
	$post = $app->request->post();
	$user = new User();
	$member = new Member();

	if( $user->exists($post['email'], $post['password']) ) {
		$member->fetch($user->id_user);
		$_SESSION['logged'] = true;
		$_SESSION['userinfo'] = $member;
		var_dump($_SESSION);
	} else {
		$err = "Email ou mot de passe incorrect.";
		$app->render('login.php');
	}

});

/*=====  End of Login  ======*/

$app->get('/', function() use($app) {
	$note = new Note();
	$notes = $note->fetchAll(2);

	$fee = new Fee();

	foreach ($notes as $key => $note) {
		$fees = $fee->fetchAll($note->id_note);
		$note->fees = $fees;
	}

	$member = (object) ['F_NAME' => 'Michel', 'L_NAME' => 'Blanc', 'LICENCE_NUM' => '170540010254'];
	$app->render('user/main.php', array('notes' => $notes, 'member' => $member));
});


$app->get('/hello/', function() {
    echo "Hello, world!";
});

$app->render('header.php');
$app->run();
$app->render('footer.php');
?>
