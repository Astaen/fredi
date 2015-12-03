<?php
    $user = $_SESSION['userinfo'];
?>
<div class="card">
    <div class="card-image">
        <img src="/public/img/bg2.jpg">
        <span class="card-title">Liste des bordereaux</span>
    </div>
    <div class="card-content blue-text">
        <div class="absolute fixed-action-btn right horizontal click-to-toggle" style="bottom: 55px; right: 24px;">
            <a class="btn-floating btn-large red">
                <i class="large mdi-navigation-menu"></i>
            </a>
            <ul>
                <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
                <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
                <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
                <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
            </ul>
        </div>    
        <p class="flow-text">Adhérent : <span class="f_name"><?= strtolower($user['f_name']); ?> </span><?= strtoupper($user['l_name']); ?></p>
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
        				<?php if($note->id_note_state == 'open') { ?>
        					<a href="/note/<?= $note->id_note; ?>/edit" class="waves-effect waves-light btn blue"><i class="material-icons left">mode_edit</i>Editer</a>
        				<?php } ?>
        			</td>
    		</tr>
    	<?php endforeach; ?>
    </tbody>		
</table>
