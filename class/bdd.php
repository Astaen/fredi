<?php
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=gsb', 'astaen', 'SQLasta6456');
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}
	$bdd->query('SET NAMES utf8');
?>