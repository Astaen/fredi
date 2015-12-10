<?php

$app->get('/login', function() use($app) {
	$app->render('login.php');
})->name('login');

$app->post('/login', function() use($app) {
	//Récuperation des données envoyées en POST
	$post = $app->request->post();

	$user = new User();
	$member = new Member();

	//Si l'utilisateur existe
	$user->id_user = $user->exists($post['email'], $post['password']);
	if($user->id_user) {
		//On récupère les infos de l'utilisateurs
		$user = $user->fetch();

		$_SESSION['logged'] = true;
		$_SESSION['userinfo'] = $user;

		$app->redirect('/');
	} else {
		$err = "Email ou mot de passe incorrect.";
		$app->render('login.php', Array('err' => $err));
	}
})->name('login');

$app->get('/signin', function() use($app) {
	$app->render('signin.php');
})->name('signin');

$app->get('/logout', function() use($app) {
	session_destroy();
	$err = "Utilisateur déconnecté.";
	$app->redirect('/login');
})->name('logout');

?>