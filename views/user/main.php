<?php

// var_dump($notes);
// var_dump($member);
//var_dump($notes);
//var_dump($member);

?>

<div class="card">
    <div class="card-image">
        <img src="/public/img/bg3.jpg">
        <span class="card-title">Tableau de bord de <span class="f_name"><?= strtolower($member['f_name']) . "</span> " . $member['l_name']; ?></span>
    </div>
    <div class="card-content blue-text">
        <p class="flow-text">Vos dépenses cette année : <?= $notes[0]->total; ?> €</p>
    </div>
    <ul class="collapsible" data-collapsible="accordion">
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
       <?php $total_amount = 0; ?>
       <?php foreach ($note->fees as $amount){
         $total_amount += $amount->amount;
       } ?>
       <tr>
         <td><?= $note->id_note; ?></td>
         <td><?= $note->year; ?></td>
         <td><?= $total_amount; ?> €</td>
         <td><button class="btn blue lighten-2"><?= $note->id_note_state; ?></button></td>
         <td><a class="waves-effect waves-light btn lighten-1" href="/note/<?= $note->id_note; ?>">Voir la fiche</a></td>
       </tr>
     <?php endforeach; ?>
   </tbody>
 </table>
