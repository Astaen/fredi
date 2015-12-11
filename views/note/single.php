<div class="card">
    <div class="card-image">
        <img src="/public/img/bg1.jpg">
        <span class="card-title">Dépenses pour l'année <?= $note->year; ?></span>
    </div>
    <div class="card-content blue-text">
        <div class="absolute fixed-action-btn right horizontal click-to-toggle" style="bottom: 55px; right: 24px;">
            <a class="btn-floating btn-large red">
                <i class="large mdi-navigation-menu"></i>
            </a>
            <ul>
                <?php if($note->id_note_state == 'open') { ?><li><a class="btn-floating blue tooltipped modal-trigger" onclick="$('#add_fee').openModal();" alt="Ajouter un frais" data-position="top" data-delay="50" data-tooltip="Ajouter un frais"><i class="material-icons">add</i></a></li><?php } ?>
                <li><a class="btn-floating green tooltipped" alt="Télécharger la fiche" data-position="top" data-delay="50" data-tooltip="Télécharger la fiche" target="_blank" href="/note/<?= $note->id_note; ?>/pdf"><i class="material-icons">file_download</i></a></li>
            </ul>
        </div>
        <p class="flow-text"><?= $note->total . " €"; ?></p>
    </div>
</div>

<table class="highlight">
    <thead>
      <tr>
          <th data-field="year">Date</th>
          <th data-field="caption">Libellé</th>
          <th data-field="amount">Montant</th>
          <th data-field="action">Action</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach ($note->fees as $fee): ?>
            <tr>
        		<td><?= $fee->creation_date; ?></td>
        		<td><?= $fee->caption; ?></td>
        		<td><?= $fee->amount . " €"; ?></td>
        		<td>
            <?php if($note->id_note_state == 'open') { ?>
              <a href="/fee/<?= $fee->id_fee; ?>/edit" class="edit_fee waves-effect waves-light btn blue"><i class="material-icons left">mode_edit</i>Editer</a>
    				  <a href="/fee/<?= $fee->id_fee; ?>/delete" onclick="return confirm('Voulez-vous vraiment supprimer ce frais ?')" class="delete grey-text"><i class="material-icons">close</i></a>
            <?php } else { ?>
              <p>Modification désactivée.</p>
            <?php } ?>
        		</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Ajout de frais -->
<div id="add_fee" class="modal modal-fixed-footer">
  <form action="/note/<?= $note->id_note; ?>/add_fee" method="post">
  <div class="modal-content">
    <h4>Ajouter un nouveau frais</h4>
    <div class="row">
        <div class="input-field col s12">
          <input placeholder="Ex: Achat de matériel" name="caption" id="caption" type="text" class="validate">
          <label for="caption">Libelle</label>
        </div>
        <div class="input-field col s12">
          <select id="fee_type" name="id_fee_type">
            <option value="km" selected>Déplacement</option>
            <option value="default">Autre</option>
          </select>
          <label>Type de frais</label>
        </div>
        <div class="input-field col s6">
          <input placeholder="Distance en km" id="amount" name="amount" type="number" step="0.01" class="validate">
          <label for="amount">Montant  / Distance parcourue</label>
        </div>
        <div class="input-field col s6">
            <input id="creation_date" type="date" name="creation_date" class="datepicker picker__input" placeholder="Cliquer içi pour sélectionner une date">
            <label for="creation_date">Date de la dépense</label>
        </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat ">Envoyer</a>
    <button type="reset" class="modal-action modal-close waves-effect waves-red btn-flat ">Annuler</a>
  </div>
  </form>  
</div>