<?php

$app->get('/note/:action(/:id)', function ($action, $id = null) use($app) {
	switch ($action) {
		case 'add':
			# code...
			break;
		
		default:
			# code...
			break;
	}
});

$app->get('/notes', function() use($app) {
	$note = new Note();
	$notes = $note->fetchAll(2);
	var_dump($notes);
});

?>