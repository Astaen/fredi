<?php
// var_dump($note);
?>

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
                <li><a class="btn-floating blue tooltipped" alt="Ajouter un frais" data-position="top" data-delay="50" data-tooltip="Ajouter un frais"><i class="material-icons">add</i></a></li>
                <li><a class="btn-floating green tooltipped" alt="Télécharger la fiche" data-position="top" data-delay="50" data-tooltip="Télécharger la fiche"><i class="material-icons">file_download</i></a></li>
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
    				<a href="/fee/<?= $fee->id_fee; ?>/edit" class="waves-effect waves-light btn blue"><i class="material-icons left">mode_edit</i>Editer</a> 
        		</td>
            </tr>
        <?php endforeach; ?>
    </tbody>		
</table>
