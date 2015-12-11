<div class="card">
    <div class="card-image">
        <img src="/public/img/bg2.jpg">
        <span class="card-title">Liste des bordereaux</span>
    </div>
    <div class="card-content blue-text">
        <p class="flow-text"><?= $user->details->club->name; ?></p>
    </div>
</div>

<table class="highlight">
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
       <?php $total_amount = 0; ?>
       <?php foreach ($note->fees as $amount){
         $total_amount += $amount->amount;
       } ?>
       <tr>
         <td><?= $note->id_note; ?></td>
         <td><?= $note->year; ?></td>
         <td><?= $total_amount; ?> €</td>
         <td><div class="chip <?= $note->id_note_state; ?>"><?= $note->libelle; ?></div></td>
         <td>
           <a class="waves-effect waves-light btn blue hide-on-med-and-down" href="/note/<?= $note->id_note; ?>"><i class="material-icons left">pageview</i>Voir la fiche</a>
           <a class="waves-effect waves-light btn blue hide-on-large-only" href="/note/<?= $note->id_note; ?>"><i class="material-icons">pageview</i></a>
         </td>
       </tr>
     <?php endforeach; ?>
   </tbody>
 </table>
