<?php
$title = 'Consultation';
ob_start();
?>
<h1>Régistre des clients</h1>
<div class="liste">
  <div class="conteneur">
    <div class="search">
      <form action="index.php" method="post">
        <input type="search" name="rechercher" placeholder="Tapez le nom du client à rechercher">
        <input type="hidden" name="controller" value="control_recherche">
        <button type="submit" name="getting"><i class="fa fa-search"></i></button>
      </form>
    </div>
    <div class="titre">
      <h1 id="titre_tableau">Liste des clients enregistrés</h1>
    </div>
  </div>
  <div class="tableau">
     <table>
       <thead>
         <tr>
           <td rowspan="2" colspan="3" id="num">Numéro</td>
           <td rowspan="2" id="nom">Nom et prénoms</td>
           <td rowspan="2" id="tel">Téléphone</td>
           <td rowspan="2" id="qtier">Quartier</td>
           <td rowspan="2" id="obj">Objectif</td>
           <td rowspan="2" id="nbreMise">Nombre de Mise</td>
           <td rowspan="2" id="mise">Mise (F CFA)</td>
           <td rowspan="2" id="montMise">Montant de la mise (F CFA)</td>
           <td colspan="2" id="statCli">Statut Client</td>
           <td rowspan="2" id="cliSF">Client Spéciale Fête</td>
           <td rowspan="2" id="cliSP">Client Spéciale Pâques</td>
           <td rowspan="2">Nombre de jours</td>
         </tr>
         <tr>
           <td>Nouveau</td>
           <td>Ancien</td>
         </tr>
       </thead>
       <tbody>
<?php
  $table = 'client_total';
  $field = '*';
  $ordre ='nomPrenoms';
  $req = $sql -> readClient($table, $field, $ordre);
  $nv = 200;
  $totalNV = 0;
  $totalMNT = 0;
  $table = '';
  if ($_SESSION['pseudo'] == 'admin' OR $_SESSION['pseudo'] == 'samfo16' OR $_SESSION['pseudo'] == 'kokossoumt') {
    while ($dt = $req -> fetch()) {
      if ($dt['statutClient'] == 'Nouveau') {
        echo '<tr><td class="num_icon"><a href="index.php?controller=control_delClient&amp;id='.$dt['id'].'&amp;name='.$dt['nomPrenoms'].'&amp;num='.$dt['phone'].'&amp;qtier='.$dt['qtier'].'&amp;obj='.$dt['objectif'].'&amp;mnt='.$dt['mntMise'].'&amp;stat=200&amp;agent='.$dt['agent'].'"><i>&cross;</i></a></td><td class="num_icon"><a href="index.php?controller=control_modiForm&amp;id='.$dt['id'].'&amp;name='.$dt['nomPrenoms'].'&amp;num='.$dt['phone'].'&amp;qtier='.$dt['qtier'].'&amp;obj='.$dt['objectif'].'&amp;nb_mise='.$dt['nbreMise'].'&amp;mise='.$dt['mise'].'&amp;mntMise='.$dt['mntMise'].'&amp;statut='.$dt['statutClient'].'&amp;sf='.$dt['Cli_SF'].'&amp;sp='.$dt['Cli_SP'].'&amp;nbreJours='.$dt['nbre_jours'].'&amp;date='.$dt['date'].'&amp;agent='.$dt['agent'].'"><i class="fa fa-pen"></i></a></td><td class="celcentre">'.$dt['id'].'</td><td>'.$dt['nomPrenoms'].'</td><td class="celcentre">'.$dt['phone'].'</td><td class="celcentre">'.$dt['qtier'].'</td><td>'.$dt['objectif'].'</td><td class="celcentre">'.$dt['nbreMise'].'</td><td class="celcentre">'.$dt['mise'].'</td><td class="celcentre">'.$dt['mntMise'].'</td><td class="celcentre">'.$nv.'</td><td class="celcentre">-</td><td class="celcentre">'.$dt['Cli_SF'].'</td><td class="celcentre">'.$dt['Cli_SP'].'</td><td class="celcentre">'.$dt['nbre_jours'].'</td></tr>';
        $totalNV += $nv;
      }else{
        echo '<tr><td class="num_icon"><a href="index.php?controller=control_delClient&amp;id='.$dt['id'].'&amp;name='.$dt['nomPrenoms'].'&amp;num='.$dt['phone'].'&amp;qtier='.$dt['qtier'].'&amp;obj='.$dt['objectif'].'&amp;mnt='.$dt['mntMise'].'&amp;stat=0&amp;agent='.$dt['agent'].'"><i>&cross;</i></a></td><td class="num_icon"><a href="index.php?controller=control_modiForm&amp;id='.$dt['id'].'&amp;name='.$dt['nomPrenoms'].'&amp;num='.$dt['phone'].'&amp;qtier='.$dt['qtier'].'&amp;obj='.$dt['objectif'].'&amp;nb_mise='.$dt['nbreMise'].'&amp;mise='.$dt['mise'].'&amp;mntMise='.$dt['mntMise'].'&amp;statut='.$dt['statutClient'].'&amp;sf='.$dt['Cli_SF'].'&amp;sp='.$dt['Cli_SP'].'&amp;nbreJours='.$dt['nbre_jours'].'&amp;date='.$dt['date'].'&amp;agent='.$dt['agent'].'"><i class="fa fa-pen"></i></a></td><td class="celcentre">'.$dt['id'].'</td><td>'.$dt['nomPrenoms'].'</td><td class="celcentre">'.$dt['phone'].'</td><td class="celcentre">'.$dt['qtier'].'</td><td>'.$dt['objectif'].'</td><td class="celcentre">'.$dt['nbreMise'].'</td><td class="celcentre">'.$dt['mise'].'</td><td class="celcentre">'.$dt['mntMise'].'</td><td class="celcentre"> - </td><td class="celcentre">&check;</td><td class="celcentre">'.$dt['Cli_SF'].'</td><td class="celcentre">'.$dt['Cli_SP'].'</td><td class="celcentre">'.$dt['nbre_jours'].'</td></tr>';
      }
      $totalMNT += $dt['mntMise'];
    }
  }else {
    if ($_SESSION['pseudo'] == 'secreSokomath') {
      //session secrétaire
      while ($dt = $req -> fetch()) {
        if ($dt['statutClient'] == 'Nouveau') {
          $table .= '<tr><td class="num_icon"><a href="index.php?controller=control_notAuthorized"><i>&cross;</i></a></td><td class="num_icon"><a href="index.php?controller=control_modiForm&amp;id='.$dt['id'].'&amp;name='.$dt['nomPrenoms'].'&amp;num='.$dt['phone'].'&amp;qtier='.$dt['qtier'].'&amp;obj='.$dt['objectif'].'&amp;nb_mise='.$dt['nbreMise'].'&amp;mise='.$dt['mise'].'&amp;mntMise='.$dt['mntMise'].'&amp;statut='.$dt['statutClient'].'&amp;sf='.$dt['Cli_SF'].'&amp;sp='.$dt['Cli_SP'].'&amp;nbreJours='.$dt['nbre_jours'].'&amp;date='.$dt['date'].'&amp;agent='.$dt['agent'].'"><i class="fa fa-pen"></i></a></td><td class="celcentre">'.$dt['id'].'</td><td>'.$dt['nomPrenoms'].'</td><td class="celcentre">'.$dt['phone'].'</td><td class="celcentre">'.$dt['qtier'].'</td><td>'.$dt['objectif'].'</td><td class="celcentre">'.$dt['nbreMise'].'</td><td class="celcentre">'.$dt['mise'].'</td><td class="celcentre">'.$dt['mntMise'].'</td><td class="celcentre">'.$nv.'</td><td class="celcentre">-</td><td class="celcentre">'.$dt['Cli_SF'].'</td><td class="celcentre">'.$dt['Cli_SP'].'</td><td class="celcentre">'.$dt['nbre_jours'].'</td></tr>';
          $totalNV += $nv;
        }else{
          $table .= '<tr><td class="num_icon"><a href="index.php?controller=control_notAuthorized"><i>&cross;</i></a></td><td class="num_icon"><a href="index.php?controller=control_modiForm&amp;id='.$dt['id'].'&amp;name='.$dt['nomPrenoms'].'&amp;num='.$dt['phone'].'&amp;qtier='.$dt['qtier'].'&amp;obj='.$dt['objectif'].'&amp;nb_mise='.$dt['nbreMise'].'&amp;mise='.$dt['mise'].'&amp;mntMise='.$dt['mntMise'].'&amp;statut='.$dt['statutClient'].'&amp;sf='.$dt['Cli_SF'].'&amp;sp='.$dt['Cli_SP'].'&amp;nbreJours='.$dt['nbre_jours'].'&amp;date='.$dt['date'].'&amp;agent='.$dt['agent'].'"><i class="fa fa-pen"></i></a></td><td class="celcentre">'.$dt['id'].'</td><td>'.$dt['nomPrenoms'].'</td><td class="celcentre">'.$dt['phone'].'</td><td class="celcentre">'.$dt['qtier'].'</td><td>'.$dt['objectif'].'</td><td class="celcentre">'.$dt['nbreMise'].'</td><td class="celcentre">'.$dt['mise'].'</td><td class="celcentre">'.$dt['mntMise'].'</td><td class="celcentre"> - </td><td class="celcentre">&check;</td><td class="celcentre">'.$dt['Cli_SF'].'</td><td class="celcentre">'.$dt['Cli_SP'].'</td><td class="celcentre">'.$dt['nbre_jours'].'</td></tr>';
        }
        $totalMNT += $dt['mntMise'];
      }
    }else {
      while ($dt = $req -> fetch()) {
        if ($dt['statutClient'] == 'Nouveau') {
          $table .= '<tr><td class="num_icon"><a href="index.php?controller=control_notAuthorized"><i>&cross;</i></a></td><td class="num_icon"><a href="index.php?controller=control_notAuthorized"><i class="fa fa-pen"></i></a></td><td class="celcentre">'.$dt['id'].'</td><td>'.$dt['nomPrenoms'].'</td><td class="celcentre">'.$dt['phone'].'</td><td class="celcentre">'.$dt['qtier'].'</td><td>'.$dt['objectif'].'</td><td class="celcentre">'.$dt['nbreMise'].'</td><td class="celcentre">'.$dt['mise'].'</td><td class="celcentre">'.$dt['mntMise'].'</td><td class="celcentre">'.$nv.'</td><td class="celcentre">-</td><td class="celcentre">'.$dt['Cli_SF'].'</td><td class="celcentre">'.$dt['Cli_SP'].'</td><td class="celcentre">'.$dt['nbreJours'].'</td></tr>';
          $totalNV += $nv;
        }else{
          $table .= '<tr><td class="num_icon"><a href="index.php?controller=control_notAuthorized"><i>&cross;</i></a></td><td class="num_icon"><a href="index.php?controller=control_notAuthorized"><i class="fa fa-pen"></i></a></td><td class="celcentre">'.$dt['id'].'</td><td>'.$dt['nomPrenoms'].'</td><td class="celcentre">'.$dt['phone'].'</td><td class="celcentre">'.$dt['qtier'].'</td><td>'.$dt['objectif'].'</td><td class="celcentre">'.$dt['nbreMise'].'</td><td class="celcentre">'.$dt['mise'].'</td><td class="celcentre">'.$dt['mntMise'].'</td><td class="celcentre"> - </td><td class="celcentre">&check;</td><td class="celcentre">'.$dt['Cli_SF'].'</td><td class="celcentre">'.$dt['Cli_SP'].'</td><td class="celcentre">'.$dt['nbreJours'].'</td></tr>';
        }
        $totalMNT += $dt['mntMise'];
      }
    }
    echo $table;
  }
  ?>
        </tbody>
        <tfoot>
           <tr>
             <td colspan="2" rowspan="2">Total</td>
             <td rowspan="2"><?=$req->rowCount(); ?></td>
             <td>Mise</td>
             <td><?php echo $totalMNT; ?></td>
           </tr>
           <tr>
             <td>Statut (Nouveaux)</td>
             <td><?php echo $totalNV; ?></td>
           </tr>
        </tfoot>
      </table>
    </div>
    </div>
  <?php
  $content = ob_get_clean();
  require('template.php');?>
