<!DOCTYPE html>
<html>
  <head>
  	<meta charset="utf-8">
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="public/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="public/css/style.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>

  <body>

	<ul id="dropdown1" class="dropdown-content">
	  <li><a href="#!">A propos</a></li>
	  <li><a href="#!">Aide</a></li>
	  <li class="divider"></li>
	  <li><a href="#!">Déconnexion</a></li>
	</ul>

	  <nav>
	    <div class="nav-wrapper blue darken-2">
	    	<a href="#" class="brand-logo">Fredi</a>
			<ul class="right hide-on-med-and-down">
				<li><a href="#">Accueil</a></li>
				<li><a href="#">Gestion des frais</a></li>
				<!-- Dropdown Trigger -->
				<li><a class="dropdown-button" href="#!" data-activates="dropdown1">Autres<i class="material-icons right">arrow_drop_down</i></a></li>
			</ul>
	    </div>
	  </nav>

  	<div class="container">
