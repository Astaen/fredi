<?php
var_dump($note);
?>

<h2>Fiche #<?= $note->id_note; ?> - Année <?= $note->year; ?></h2>

<div class="card">
    <div class="card-content blue-text">
        <span class="card-title">Dépenses</span>
        <h2><?= $note->total . " €"; ?></h2>
    </div>
</div>

<table class="highlight">
    <thead>
      <tr>
          <th data-field="year">Année</th>
          <th data-field="state">Etat</th>
          <th data-field="amount">Total</th>
          <th data-field="action">Action</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach ($this->fees as $fee): ?>
            <tr>
        		<td><?= $note->year; ?></td>
        		<td><div class="chip <?= $note->id_note_state; ?>"><?= $note->libelle; ?></div></td>
        		<td><?= $note->total . " €"; ?></td>
        		<td>
        			<a href="/note/<?= $note->id_note; ?>" class="waves-effect waves-light btn"><i class="material-icons left">pageview</i>Afficher</a>
        			<?php if($note->id_note_state == 'open') { ?>
        				<a href="/note/<?= $note->id_note; ?>/edit" class="waves-effect waves-light btn"><i class="material-icons left">mode_edit</i>Editer</a>
        			<?php } ?>
        		</td>
            </tr>
        <?php endif; ?>
    </tbody>		
</table>
