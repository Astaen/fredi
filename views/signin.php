<?php if(isset($errors)): ?>
<div class="row">
  <div class="col s12 m12 l12">
    <div class="card-panel red">
      <ul>
          <?php foreach($errors as $err): ?>
            <li class="white-text"><?= $err; ?></li>
          <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>
<?php endif; ?>

<div class="row">
  <form class="col s12" method="post" action="/signin">
      <div class="row">
        <div class="input-field col s12 m12 l6">
          <i class="material-icons prefix">person</i>
          <input id="licence" type="number" class="validate" name="licence_num">
          <label for="licence">Votre numéro de licence</label>
        </div>
        <div class="input-field col s12 m12 l6">
          <i class="material-icons prefix">email</i>
          <input id="last_name" type="email" class="validate" name="mail">
          <label for="last_name">Adresse email</label>
        </div>
        <div class="input-field col s12 m12 l6">
          <i class="material-icons prefix">lock</i>
          <input id="password" type="password" class="validate" name="password">
          <label for="password">Choisir un mot de passe</label>
        </div>
        <div class="input-field col s12 m12 l6">
          <i class="material-icons prefix">lock</i>
          <input id="password_confirm" type="password" class="validate" name="password_confirm">
          <label for="password_confirm">Confirmer le mot de passe</label>
        </div>
      </div>
      <div class="row">
        <button type="submit" class="waves-effect waves-light btn blue"><i class="material-icons right">person_add</i> S'inscrire</button>
      </div>
    </form>
</div>
