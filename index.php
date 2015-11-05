<?php
session_start();
require 'vendor/autoload.php';

include("models/user.php");

$user = new User();
$user->create(Array(
		'f_name' => 'Sofiane',
		'l_name' => 'Hamadi'
	));
$user->save();

//bleh
?>
