<?php
    $user = $_SESSION['userinfo'];
    // var_dump($user);
?>
<div class="card">
    <div class="card-image">
        <img src="/public/img/bg2.jpg">
        <span class="card-title">Liste des bordereaux</span>
    </div>
    <div class="card-content blue-text">
        <p class="flow-text">Adhérent : <span class="f_name"><?= strtolower($user->f_name); ?> </span><?= strtoupper($user->l_name); ?></p>
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
    	<?php foreach ($notes as $key => $note): ?>
    		<tr>
        			<td><?= date("Y", strtotime($note->year)); ?></td>
        			<td><div class="chip <?= $note->id_note_state; ?>"><?= $note->libelle; ?></div></td>
        			<td><?= $note->total . " €"; ?></td>
        			<td>
        				<a href="/note/<?= $note->id_note; ?>" class="waves-effect waves-light btn blue"><i class="material-icons left">pageview</i>Afficher</a>
<!--         				<?php if($note->id_note_state == 'open') { ?>
        					<a href="/note/<?= $note->id_note; ?>/edit" class="waves-effect waves-light btn blue"><i class="material-icons left">mode_edit</i>Editer</a>
        				<?php } ?> -->
        			</td>
    		</tr>
    	<?php endforeach; ?>
    </tbody>		
</table>
