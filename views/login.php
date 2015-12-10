<h2>Connexion</h2>

<?php if(isset($err)) { ?>
<div class="row">
    <div class="card-panel red">
      <span class="white-text"><?= $err; ?></span>
    </div>
</div>
<?php } ?>

<div class="row">
	<form action="/login" method="post">

		<div class="row">
	        <div class="input-field">
				<i class="material-icons prefix">email</i>
				<input id="mail" type="email" name="email" class="validate blue-text text-darken-2" autofocus>
				<label for="first_name">Adresse e-mail</label>
	        </div>
	    </div>

		<div class="row">
	        <div class="input-field">
				<i class="material-icons prefix">lock</i>
				<input id="password" type="password" name="password" class="validate blue-text text-darken-2">
				<label for="first_name">Mot de passe</label>
	        </div>
		</div>

		<button class="btn waves-effect waves-light right blue darken-2" type="submit" name="action">Connexion
		<i class="material-icons right">send</i>
		</button>		

	</form>
	<div class="clear"></div>
	<br>
	<p class="flow-text align-center">Pas encore inscrit ? <a href="/signin">Cliquez ici pour vous enregistrer.</a></p>
</div>		
