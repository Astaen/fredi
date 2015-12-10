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

  <!-- Dropdown ecran -->
	<ul id="dropdown-large" class="dropdown-content">
	  <li><a href="/about">A propos</a></li>
	  <li><a href="/help">Aide</a></li>
	  <li class="divider"></li>
	  <li><a href="/logout">Déconnexion</a></li>
	</ul>

	  <nav>
      <!-- MENU ECRAN -->
	    <div class="nav-wrapper blue darken-1 hide-on-med-and-down">
	    	<a href="/" class="brand-logo">Fredi</a>
	    	<?php if(isset($_SESSION['logged'])): ?>
  			<ul class="right">
  				<li><a href="/">Accueil</a></li>
  				<li><a href="/notes">Gestion des frais</a></li>
  				<!-- Dropdown Trigger -->
  				<li><a class="dropdown-button" href="#!" data-activates="dropdown-large">Autres<i class="material-icons right">arrow_drop_down</i></a></li>
  			<?php else: ?>
  				<li><a href="/">Connexion</a></li>
  			</ul>
        <?php endif; ?>
      </div>
      <!-- MENU MOBILE / TABLETTE -->
      <div class="nav-wrapper blue darken-1 hide-on-large-only">
        <a href="/" class="brand-logo">Fredi</a>
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="side-nav" id="slide-out">
        <?php if(isset($_SESSION['logged'])): ?>
          <li><a href="/">Accueil</a></li>
  				<li><a href="/notes">Gestion des frais</a></li>
          <li><a href="/about">A propos</a></li>
      	  <li><a href="/help">Aide</a></li>
      	  <li class="divider"></li>
      	  <li><a href="/logout">Déconnexion</a></li>
        <?php else: ?>
          <li><a href="/">Connexion</a></li>
        <?php endif; ?>
        </ul>
	    </div>
	  </nav>

  	<div class="container" id="main">
