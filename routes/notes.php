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

?>