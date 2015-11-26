<?php

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

$app->get('/logout', function() use($app) {
	session_destroy();
	$err = "Utilisateur déconnecté.";
	$app->render('login.php', Array('err' => $err));	
});

?>