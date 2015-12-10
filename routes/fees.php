<?php

$app->get('/fee/:id(/:action)', function($id = null, $action = null) use($app) {
	if(isset($id) && isset($action)) {
		switch ($action) {
			case 'edit':
					$fee = new Fee(Array('id_fee' => $id));
					$fee = $fee->fetch();
					$app->render('fee/edit.php', Array('fee' => $fee));
				break;
			default:
				# code...
				break;
		}
	} else {
		$fee = new Fee(Array('id_fee' => $id));
		$fee = $fee->fetch();
		$data = Array();

		if($fee) {
			$data = $fee;
		} else {
			$data['err'] = "Impossible de récupérer le frais";
		}

		//Le frais est récupéré en AJAX, donc on retourne du JSON exploitable
	    $response = $app->response();
	    $response['Content-Type'] = 'application/json';
	    $response->body(json_encode($data));	
	}
})->name('fee');

$app->post('/fee/:id(/:action)', function($id = null, $action = null) use($app) {
	$post = $app->request->post();

	if(isset($id) && isset($action)) {
		switch ($action) {
			case 'edit':
				$fee = new Fee($post);
				$fee->id_fee = $id;
				
				if($fee->save()) {
					$fee = $fee->fetch();
				} else {
					$err = "No";
				}

				$app->redirect('/note/'.$fee->id_note);
				break;

			default:
				# code...
				break;
		}
	}
})->name('fee');

?>