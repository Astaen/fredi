<!DOCTYPE html>
<html>
  <head>
  	<title><?= $title; ?></title>
  	<meta charset="utf-8">
    <!--Import Google Icon Font-->
    <link href="/public/css/material-icons.css" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="/public/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="/public/css/style.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>

  <body>


	<ul id="dropdown1" class="dropdown-content">
	  <li><a href="/about">A propos</a></li>
	  <li><a href="/help">Aide</a></li>
	  <li class="divider"></li>
	  <li><a href="/logout">Déconnexion</a></li>
	</ul>

	  <nav>
	    <div class="nav-wrapper blue darken-1">
	    	<a href="/" class="brand-logo">Fredi</a>
	    	<?php if(isset($_SESSION['logged'])) { ?>
			<ul class="right hide-on-med-and-down">
				<li><a href="/">Accueil</a></li>
				<li><a href="/notes">Gestion des frais</a></li>
				<!-- Dropdown Trigger -->
				<li><a class="dropdown-button" href="#!" data-activates="dropdown1">Autres<i class="material-icons right">arrow_drop_down</i></a></li>
			</ul>
			<?php } else { ?>
			<ul class="right">
				<li><a href="/">Connexion</a></li>
			</ul>
			<?php } ?>
	    </div>
	  </nav>


  	<div class="container" id="main">
