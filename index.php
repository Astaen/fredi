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
require("models/User.php");
require("models/Member.php");
require("models/Note.php");
require("models/Fee.php");

//instanciation de slim
$app = new \Slim\Slim();

$app->config(array(
	'templates.path' => './views'
));

$app->get('/', function() use($app) {
	if($_SESSION['logged']) {
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

/*=============================
=            Login            =
=============================*/
$app->get('/login', function() use($app) {
	$app->render('login.php');
});

$app->post('/login', function() use($app) {
	//Récuperation des données envoyées en POST
	$post = $app->request->post();

	$user = new User();
	$member = new Member();

	//Si l'utilisateur existe
	$user->id_user = $user->exists($post['email'], $post['password']);
	if($user->id_user) {
		//On récupère les infos de l'utilisateurs
		$user->fetch();
		//On récupère les infos du membre correspondant
		$member->fetch($user->licence_num);

		$_SESSION['logged'] = true;
		$_SESSION['userinfo'] = $member;

		$app->redirect('/');
	} else {
		$err = "Email ou mot de passe incorrect.";
		$app->render('login.php', Array('err' => $err));
	}
});
/*=====  End of Login  ======*/

$app->get('/logout', function() use($app) {
	session_destroy();
	$err = "Utilisateur déconnecté.";
	$app->render('login.php', Array('err' => $err));	
});


$app->get('/hello/', function() {
    echo "Hello, world!";
});

/* CUSTOM ROUTES */
require 'routes/notes.php';

$app->render('header.php');
$app->run();
$app->render('footer.php');
?>
