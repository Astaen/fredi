<div class="card">
    <div class="card-image">
        <img src="/public/img/bg5.jpg">
        <span class="card-title">Édition de frais</span>
    </div>
</div>

<div class="row">
  <form action="/fee/<?= $fee->id_fee; ?>/edit" method="post" class="col s12">
    <div class="input-field col s12 m12 l6">
      <input placeholder="Ex: Achat de matériel" id="caption" type="text" class="validate" value="<?= $fee->caption; ?>" name="caption">
      <label for="caption">Libelle</label>
    </div>
    <div class="input-field col s12 m12 l6">
      <select id="fee_type" name="id_fee_type">
        <option value="km" <?= ($fee->id_fee_type == 'km')?"selected":""; ?>>Déplacement</option>
        <option value="default" <?= ($fee->id_fee_type == 'default')?"selected":""; ?>>Autre</option>
      </select>
      <label>Type de frais</label>
    </div>
    <div class="input-field col s12 m12 l6">
        <input id="creation_date" name="creation_date" type="date" class="datepicker picker__input" placeholder="Cliquer içi pour sélectionner une date" value="<?= $fee->creation_date; ?>">
        <label for="creation_date">Date de la dépense</label>
    </div>
    <div class="input-field col s12 m12 l6">
      <input placeholder="Distance en km" id="amount" type="number" step="1.00" class="validate" value="<?= $fee->amount; ?>" name="amount">
      <span class="after-input fee-type"><?= $fee->id_fee_type == 'km'?"km":"€"; ?></span>
      <label for="amount">Montant</label>
    </div>
    <button type="submit" class="btn waves-effect waves-light blue" type="submit">Modifier<i class="material-icons right">send</i></button>
  </form>
</div>
