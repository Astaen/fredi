<?php

$app->get('/note/:id(/:action)', function ($id, $action = null) use($app) {
	if(isset($action)) {
		switch ($action) {
			case 'edit':
				# code...
				break;

			case 'delete':
				# code...
				break;

			case 'pdf':
				$note = new Note();
				$note = $note->fetch($id);
				$fees = $note->fees;
				$user = new User();
				$user = $user->fetch($note->id_user);
				$member = $user->details;
				include('class/PDF.php');
				$app->redirect($link);
				break;

			default:
				# code...
				break;
		}
	} else {
		$note = new Note();
		$note = $note->fetch($id);
		$app->render('note/single.php', Array('note' => $note));
	}

});

$app->post('/note/:id(/:action)', function ($id, $action = null) use($app) {
	if(isset($action)) {
		switch ($action) {

			case 'add_fee':
				$post = $app->request->post();
				$fee = new Fee($post);
				$fee->id_note = $id;
				
				if(!$fee->save()) {
					$err = "No";
				}

				$app->redirect('/note/'.$fee->id_note);
				break;

			default:
				# code...
				break;
		}
	}
});

$app->get('/notes', function() use($app) {
	$note = new Note();
	$notes = $note->fetchAll(2);
	$app->render('note/list.php', Array('notes' => $notes, 'user' => $_SESSION['userinfo']));
});




?>
