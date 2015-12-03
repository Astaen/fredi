<div class="card">
    <div class="card-image">
        <img src="/public/img/bg3.jpg">
        <span class="card-title">Tableau de bord de <span class="f_name"><?= strtolower($user->details->f_name) . "</span> " . $user->details->l_name; ?></span>
    </div>
    <div class="card-content blue-text">
        <p class="flow-text">Vos dépenses cette année : <?= $notes[0]->total; ?> €</p>
    </div>
    <ul class="collapsible" data-collapsible="accordion" id="dashboard-fees">
      <?php foreach($notes as $note): ?>
        <?php foreach($note->fees as $fee): ?>
        <li>
          <div class="collapsible-header"><i class="material-icons">trending_flat</i><?= $fee->caption; ?></div>
          <div class="collapsible-body"><p>Montant de <b><?= $fee->amount; ?></b> € ajouté le <?= $fee->creation_date; ?></p></div>
        </li>
        <?php endforeach; ?>
      <?php endforeach; ?>
    </ul>
</div>

<div class="row">
  <div class="col s12">
    <h4>Vos anciennes fiches de frais</h4>
  </div>
</div>

<table>
   <thead>
     <tr>
         <th data-field="id_note"><i class="material-icons">description</i></th>
         <th data-field="year">Année</th>
         <th data-field="amount">Montant total</th>
         <th data-field="id_note_state">État</th>
     </tr>
   </thead>
   <tbody>
     <?php foreach ($notes as $note):?>
       <tr>
         <td><?= $note->id_note; ?></td>
         <td><?= $note->year; ?></td>
         <td><?= $note->total; ?> €</td>
         <td><div class="chip <?= $note->id_note_state; ?>"><?= $note->libelle; ?></div></td>
         <td><a class="waves-effect waves-light btn blue" href="/note/<?= $note->id_note; ?>"><i class="material-icons left">pageview</i>Voir la fiche</a></td>
       </tr>
     <?php endforeach; ?>
   </tbody>
 </table>
