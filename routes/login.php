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


$app->post('/signin', function() use($app) {
	$post = $app->request->post();
	$err = Array();
	$member = new Member();
	$user = new User($app->request->post());
	$user->id_type = 1;

	// Vérifie le numéro de licence
	if($member->exists($post['licence_num']) != false) {
		$err[] = "Votre numéro de licence est incorrect.";
	}
	else {
		// Vérifie de l'email
		if($user->exists($post['mail']) != false) {
			$err[] = "Cette adresse email est ddéjà prise.";
		}
	}
	// Vérifie si les mdp sont identiques
	if($post['password'] != $post['password_confirm']) {
		$err[] = "Vos mots de passe ne sont pas identiques.";
	}
	// Vérifie si y'a des erreurs
	if(empty($err)) {
		$user = $user->save();
		$note = new Note();
		$app->redirect('/');
	} else {
		$app->render('signin.php', array("errors" => $err));
	}
})->name('signin');


$app->get('/logout', function() use($app) {
	session_destroy();
	$err = "Utilisateur déconnecté.";
	$app->redirect('/login');
})->name('logout');

?>
