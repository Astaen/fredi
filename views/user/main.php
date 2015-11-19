<?php
var_dump($notes);
var_dump($member);
?>
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
