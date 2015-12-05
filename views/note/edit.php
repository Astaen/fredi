<div class="card">
    <div class="card-image">
        <img src="/public/img/bg5.jpg">
        <span class="card-title">Édition de frais</span>
    </div>
</div>
<?php if(isset($flash)): ?>
<div class="col s12">
  <?php foreach($flash as $k => $message): ?>
  <p class="card-panel z-depth-1 <?= $k; ?>"><b><?= $message ?></b></p>
  <?php endforeach; ?>
</div>
<?php endif; ?>

<div class="row">
  <form action="/fee/<?= $fee->id_fee; ?>/edit" method="post" class="col s12">
    <div class="input-field col s6">
      <input placeholder="Ex: Achat de matériel" id="caption" type="text" class="validate" value="<?= $fee->caption; ?>" name="caption">
      <label for="caption">Libelle</label>
    </div>
    <div class="input-field col s6">
      <select id="fee_date" name="id_fee_type">
        <option value="km" <?= ($fee->id_fee_type == 'km')?"selected":""; ?>>Déplacement</option>
        <option value="default" <?= ($fee->id_fee_type == 'default')?"selected":""; ?>>Autre</option>
      </select>
      <label>Type de frais</label>
    </div>
    <div class="input-field col s6">
        <input id="creation_date" type="date" class="datepicker picker__input" placeholder="Cliquer içi pour sélectionner une date" value="<?= $fee->creation_date; ?>">
        <label for="creation_date">Date de la dépense</label>
    </div>
    <div class="input-field col s6">
      <input placeholder="Distance en km" id="amount" type="number" step="0.01" class="validate" value="<?= $fee->amount; ?>" name="amount">
      <label for="amount">Montant</label>
    </div>
    <button class="btn waves-effect waves-light blue" type="submit">Modifier<i class="material-icons right">send</i></button>
  </form>
</div>
