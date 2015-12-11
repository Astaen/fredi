<div class="card">
    <div class="card-image">
        <img src="/public/img/bg3.jpg">
        <span class="card-title">Bienvenue, <span class="f_name"><?= strtolower($user->details->f_name) . "</span> " . $user->details->l_name; ?></span>
    </div>
    <div class="card-content blue-text">
        <p class="flow-text">Votre solde au <?= date('d/m/Y'). " : " . $notes[0]->total; ?> €</p>
    </div>

    <ul class="collection with-header">
        <?php if(sizeof($notes[0]->fees)): ?><li class="collection-header"><h4>Détails</h4></li><?php endif; ?>
        <?php foreach($notes[0]->fees as $fee): ?>
          <li class="collection-item"><?= date('d/m/Y',strtotime($fee->creation_date)) . " - " . $fee->caption; ?><span class="secondary-content"><?= $fee->amount . " €"; ?></span></li>
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
     <?php foreach ($notes as $index => $note):?>
       <tr>
         <td><?= $index+1; ?></td>
         <td><?= $note->year; ?></td>
         <td><?= $note->total; ?> €</td>
         <td><div class="chip <?= $note->id_note_state; ?>"><?= $note->libelle; ?></div></td>
         <td>
           <a class="waves-effect waves-light btn blue hide-on-large-only" href="/note/<?= $note->id_note; ?>"><i class="material-icons">pageview</i></a>
           <a class="waves-effect waves-light btn blue hide-on-med-and-down" href="/note/<?= $note->id_note; ?>"><i class="material-icons left">pageview</i>Voir la fiche</a>
         </td>
       </tr>
     <?php endforeach; ?>
   </tbody>
 </table>
