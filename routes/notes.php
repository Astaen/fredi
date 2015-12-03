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
	$app->render('note/list.php', Array('notes' => $notes));
});

?>