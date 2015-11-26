<?php
// var_dump($notes);
?>
<h2>Gestion des frais</h2>
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
    	<?php foreach ($notes as $key => $note): ?>
    		<tr>
        			<td><?= date("Y", strtotime($note->year)); ?></td>
        			<td><div class="chip <?= $note->id_note_state; ?>"><?= $note->libelle; ?></div></td>
        			<td><?= $note->total . " €"; ?></td>
        			<td>
        				<a href="/note/show/<?= $note->id_note; ?>" class="waves-effect waves-light btn"><i class="material-icons left">pageview</i>Afficher</a>
        				<?php if($note->id_note_state == 'open') { ?>
        					<a href="/note/edit/<?= $note->id_note; ?>" class="waves-effect waves-light btn"><i class="material-icons left">mode_edit</i>Editer</a>
        				<?php } ?>
        			</td>
    		</tr>
    	<?php endforeach; ?>
    </tbody>		
</table>
