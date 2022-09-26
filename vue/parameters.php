<?php
$title = 'Paramètres';
ob_start();
?>
<h1>Liste des agents</h1><br>
<table class="table_para">
  <caption></caption>
  <thead>
    <tr>
      <td id="sup" colspan="2">Action</td>
      <td>Nom et Prénoms</td>
      <td class="phoneC">Contact</td>
      <td>Adresse mail</td>
      <td class="pseudoC">Pseudo</td>
    </tr>
  </thead>
  <tbody>
    <?php
      $table = 'user';
      $field = '*';
      $ordre = 'nomPrenoms';
      $req = $sql -> getUsers($table, $field, $ordre);
      while ($dt = $req -> fetch()) {
        if ($dt['pseudo'] != 'admin') {
          echo '<tr><td><a class="actionIn" href="index.php?controller=control_delUsers&amp;id='.$dt['id'].'">&cross;</a></td><td><a class="actionIn" href="index.php?controller=control_updateUsers&amp;id='.$dt['id'].'&amp;nomPrenoms='.$dt['nomPrenoms'].'&amp;phone='.$dt['contact'].'&amp;mail='.$dt['mail'].'&amp;pseudo='.$dt['pseudo'].'"><i class="fa fa-pen"></i></a></td><td>'.$dt['nomPrenoms'].'</td><td class="phoneC">'.$dt['contact'].'</td><td>'.$dt['mail'].'</td><td class="pseudoC">'.$dt['pseudo'].'</td></tr>';
        }
      }
     ?>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="6">Copyright @ <?=date('Y')?></td>
    </tr>
  </tfoot>
</table>
<?php
$content = ob_get_clean();
require('template.php');
