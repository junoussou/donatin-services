<?php
$title = 'Résultat';
ob_start();
?><h1>Résultat de la recherche</h1><?php
if (isset($_POST['getting'])) {
  if (!empty($_POST['rechercher'])) {
    $table = 'client_total';
    $field = '*';
    //$condition = '?';
    $data = '%'.$_POST['rechercher'].'%';
    $req = $sql -> getClient($table, $field, $data);
    if ($req -> rowCount()!=0) {
      $nv = 200;
      $totalNV = 0;
      $totalMNT = 0;
      $table = '<br><br><table class="tableSearch">';
      $table .= '<thead>
                    <tr>
                      <td rowspan="2" id="s_num" colspan="3">Numéro</td>
                      <td rowspan="2" id="s_nom">Nom et prénoms</td>
                      <td rowspan="2" id="s_tel">Téléphone</td>
                      <td rowspan="2" id="s_qtier">Quartier</td>
                      <td rowspan="2" id="s_obj">Objectif</td>
                      <td rowspan="2" id="s_nbreMise">Nombre de Mise</td>
                      <td rowspan="2" id="s_mise">Mise (F CFA)</td>
                      <td rowspan="2" id="s_montMise">Montant de la mise (F CFA)</td>
                      <td colspan="2" id="s_statCli">Statut Client</td>
                      <td rowspan="2" id="s_cliSF">Client Spéciale Fête</td>
                      <td rowspan="2" id="s_cliSP">Client Spéciale Pâques</td>
                      <td rowspan="2">Nombre de jours</td>
                    </tr>
                    <tr>
                      <td>Nouveau</td>
                      <td>Ancien</td>
                    </tr>
                  </thead><tbody>';
                  if ($_SESSION['pseudo'] == 'admin' OR $_SESSION['pseudo'] == 'samfo16' OR $_SESSION['pseudo'] == 'kokossoumt') {
                    while ($dt = $req -> fetch()) {
                      if ($dt['statutClient'] == 'Nouveau') {
                        $table .= '<tr><td class="num_icon"><a href="index.php?controller=control_delClient&amp;id='.$dt['id'].'&amp;name='.$dt['nomPrenoms'].'&amp;num='.$dt['phone'].'&amp;qtier='.$dt['qtier'].'&amp;obj='.$dt['objectif'].'&amp;mnt='.$dt['mntMise'].'&amp;stat=200&amp;agent='.$dt['agent'].'"><i>&cross;</i></a></td><td class="num_icon"><a href="index.php?controller=control_modiForm&amp;id='.$dt['id'].'&amp;name='.$dt['nomPrenoms'].'&amp;num='.$dt['phone'].'&amp;qtier='.$dt['qtier'].'&amp;obj='.$dt['objectif'].'&amp;nb_mise='.$dt['nbreMise'].'&amp;mise='.$dt['mise'].'&amp;mntMise='.$dt['mntMise'].'&amp;statut='.$dt['statutClient'].'&amp;sf='.$dt['Cli_SF'].'&amp;sp='.$dt['Cli_SP'].'&amp;nbreJours='.$dt['nbre_jours'].'&amp;date='.$dt['date'].'&amp;agent='.$dt['agent'].'"><i class="fa fa-pen"></i></a></td><td class="celcentre">'.$dt['id'].'</td><td>'.$dt['nomPrenoms'].'</td><td class="celcentre">'.$dt['phone'].'</td><td class="celcentre">'.$dt['qtier'].'</td><td>'.$dt['objectif'].'</td><td class="celcentre">'.$dt['nbreMise'].'</td><td class="celcentre">'.$dt['mise'].'</td><td class="celcentre">'.$dt['mntMise'].'</td><td class="celcentre">'.$nv.'</td><td class="celcentre">-</td><td class="celcentre">'.$dt['Cli_SF'].'</td><td class="celcentre">'.$dt['Cli_SP'].'</td><td class="celcentre">'.$dt['nbre_jours'].'</td></tr>';
                        $totalNV += $nv;
                      }else{
                        $table .= '<tr><td class="num_icon"><a href="index.php?controller=control_delClient&amp;id='.$dt['id'].'&amp;name='.$dt['nomPrenoms'].'&amp;num='.$dt['phone'].'&amp;qtier='.$dt['qtier'].'&amp;obj='.$dt['objectif'].'&amp;mnt='.$dt['mntMise'].'&amp;stat=0&amp;agent='.$dt['agent'].'"><i>&cross;</i></a></td><td class="num_icon"><a href="index.php?controller=control_modiForm&amp;id='.$dt['id'].'&amp;name='.$dt['nomPrenoms'].'&amp;num='.$dt['phone'].'&amp;qtier='.$dt['qtier'].'&amp;obj='.$dt['objectif'].'&amp;nb_mise='.$dt['nbreMise'].'&amp;mise='.$dt['mise'].'&amp;mntMise='.$dt['mntMise'].'&amp;statut='.$dt['statutClient'].'&amp;sf='.$dt['Cli_SF'].'&amp;sp='.$dt['Cli_SP'].'&amp;nbreJours='.$dt['nbre_jours'].'&amp;date='.$dt['date'].'&amp;agent='.$dt['agent'].'"><i class="fa fa-pen"></i></a></td><td class="celcentre">'.$dt['id'].'</td><td>'.$dt['nomPrenoms'].'</td><td class="celcentre">'.$dt['phone'].'</td><td class="celcentre">'.$dt['qtier'].'</td><td>'.$dt['objectif'].'</td><td class="celcentre">'.$dt['nbreMise'].'</td><td class="celcentre">'.$dt['mise'].'</td><td class="celcentre">'.$dt['mntMise'].'</td><td class="celcentre"> - </td><td class="celcentre">&check;</td><td class="celcentre">'.$dt['Cli_SF'].'</td><td class="celcentre">'.$dt['Cli_SP'].'</td><td class="celcentre">'.$dt['nbre_jours'].'</td></tr>';
                      }
                      $totalMNT += $dt['mntMise'];
                    }
                  }else{
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
                  }
      $table .= '</tbody><tfoot>
                    <tr>
                      <td colspan="3" rowspan="2">Total</td>
                      <td>Mise</td>
                      <td>'.$totalMNT.'</td>
                    </tr>
                    <tr>
                      <td>Statut (Nouveaux)</td>
                      <td>'.$totalNV.'</td>
                    </tr>
                </tfoot>';
      $table .= '</table>';
      echo $table;
    }else{
      echo '<script type="text/javascript">alert("Aucun n\'enregistrement trouvé")</script>';
    }
  }else{
    echo '<script type="text/javascript">alert("Veuillez renseigner le champ de recherche")</script>';
  }
}
$content = ob_get_clean();
require('template.php');?>
