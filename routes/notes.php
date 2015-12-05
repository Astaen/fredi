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

$app->get('/notes', function() use($app) {
	$note = new Note();
	$notes = $note->fetchAll(2);
	$app->render('note/list.php', Array('notes' => $notes, 'user' => $_SESSION['userinfo']));
});

/**
 * FEE - EDITION
 */
$app->get('/fee/:id(/:action)', function($id = null, $action = null) use($app) {
	if(isset($id) && isset($action)) {
		switch ($action) {
			case 'edit':
				$fee = new Fee();
				$edit_fee = $fee->fetch($id);
				$app->render('note/edit.php', Array('fee' => $edit_fee));
				break;

			default:
				# code...
				break;
		}
	}
});
$app->post('/fee/:id(/:action)', function($id = null, $action = null) use($app) {
	if(isset($id) && isset($action)) {
		switch ($action) {
			case 'edit':
				$_POST['id_fee'] = $id; // Array push
				$fee = new Fee($_POST);
				$err = $fee->save();
				if($err) {
					$app->flash('green', "La modification c'est correctement éffectué."); // Succès
				} else {
					$app->flash('red', "La modification n'a pas pû être éffectué."); // Erreur
				}
				$edit_fee = $fee->fetch($id);
				$app->render('note/edit.php', Array('fee' => $edit_fee, 'flash' => $_SESSION['slim.flash']));
				break;

			default:
				# code...
				break;
		}
	}
});

?>
