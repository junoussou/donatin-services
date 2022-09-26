<?php
  require('model.php');
  //historique
  function control_addSalaire(){
    $sql = new Client();
    if (isset($_GET['enregSalaire'])) {
      $table = 'historique';
      $field = 'date, motif, entree, sortie, agent';
      $value = '?, ?, ?, ?, ?';
      $date = ''.date('Y').'-'.date('m').'-'.date('d').'';
      $motif = 'Salaire payé pour '.$_GET['nameAgent'].'';
      $data = array($date, $motif, 0, $_GET['salaire'], $_GET['nameAgent']);
      $sql -> addClient($table, $field, $value, $data);
      header('Location:index.php?controller=control_history');
    }
  }
  function control_historyParAgent(){
    $title = 'Historique';
    $sql = new Client();
    $resultget = '';
    if (isset($_GET['validEnvoyAgent'])) {
      $debut = $_GET['dateDebutAgent'];
      $fin = $_GET['dateFinAgent'];
      $table = 'historique';
      $field = '*';
      $agent = '?';
      $date1 = '?';
      $date2 = '?';
      $data = array($_GET['nomAgent'], $debut, $fin);
      $ttentrant = '';
      $ttsortant = '';
      $req = $sql -> getPeriodeParAgent($table, $field, $date1, $date2, $agent, $data);
      if ($req -> rowCount() >= 1) {
        $resultget .= '<tr><td rowspan="'.$req -> rowCount().'">De '.$debut.' A '.$fin.'</td>';
        while ($dt = $req -> fetch()) {
          $resultget .= '<td>'.$dt['motif'].'</td><td>'.$dt['entree'].'</td><td>'.$dt['sortie'].'</td><td>'.$dt['agent'].'</td></tr>';
          $ttentrant += $dt['entree'];
          $ttsortant += $dt['sortie'];
        }
        $resultget .= '<tr><td colspan="2" rowspan="2">Total</td><td>'.$ttentrant.'</td><td>'.$ttsortant.'</td><td rowspan="2">-</td></tr>';
        $ttTotal = $ttentrant - $ttsortant;
        $resultget .= '<tr><td colspan="2">'.$ttTotal.'</td></tr>';
      }else {
        echo '<script type="text/javascript">alert(\'Aucun enregistrement trouvé pour cette période au nom de \''.$_GET['nomAgent'].')</script>';
      }
      require('vue/history.php');
    }
  }
  function control_history(){
    $title = 'Historique';
    $sql = new Client();
    $resultget = '';
    if (isset($_GET['validEnvoy'])) {
      $debut = $_GET['dateDebut'];
      $fin = $_GET['dateFin'];
      $table = 'historique';
      $field = '*';
      $date1 = '?';
      $date2 = '?';
      $data = array($debut, $fin);
      $ttentrant = '';
      $ttsortant = '';
      $req = $sql -> getPeriode($table, $field, $date1, $date2, $data);
      if ($req -> rowCount() >= 1) {
        $resultget .= '<tr><td rowspan="'.$req -> rowCount().'">De '.$debut.' A '.$fin.'</td>';
        while ($dt = $req -> fetch()) {
          $resultget .= '<td>'.$dt['motif'].'</td><td>'.$dt['entree'].'</td><td>'.$dt['sortie'].'</td><td>'.$dt['agent'].'</td></tr>';
          $ttentrant += $dt['entree'];
          $ttsortant += $dt['sortie'];
        }
        $resultget .= '<tr><td colspan="2" rowspan="2">Total</td><td>'.$ttentrant.'</td><td>'.$ttsortant.'</td><td rowspan="2">-</td></tr>';
        $ttTotal = $ttentrant - $ttsortant;
        $resultget .= '<tr><td colspan="2">'.$ttTotal.'</td></tr>';
      }else {
        echo '<script type="text/javascript">alert(\'Aucun enregistrement trouvé pour cette période\')</script>';
      }
    }
    require('vue/history.php');
  }
  function control_carburanConnexion(){
    $sql = new Client();
    if (isset($_GET['enregis'])) {
      if (!empty($_GET['motifHis']) And !empty($_GET['dateCarbuConn']) AND !empty($_GET['montantHis'])) {
        $table = 'historique';
        $field = 'date, motif, entree, sortie, agent';
        $value = '?, ?, ?, ?, ?';
        if ($_GET['motifHis'] == 'Connexion') {
          $data = array($_GET['dateCarbuConn'], $_GET['motifHis'], 0, $_GET['montantHis'], '-');
        }else {
          $data = array($_GET['dateCarbuConn'], 'Carburant', 0, $_GET['montantHis'], $_GET['motifHis']);
        }
        $sql -> addClient($table, $field, $value, $data);
      }else {
        echo '<script type="text/javascript">alert(\'Renseignez les champs vides\')</script>';
      }
    }
    header('Location:index.php?controller=control_history');
  }
  //authorisations
  function control_notAuthorized(){
    $title = 'Non authorisé';
    $content = '<div class="fas fa-danger notAuthorized"><p class="fas fa-heart-broken"><p><p>Vous n\'avez pas l\'acréditation nécéssaire. Veuillez vous rapprocher des administrateurs. Merci</p><p><a href="index.php?contoller=control_inscription">Retour à la page d\'inscription</a></p></div>';
    require('vue/template.php');
  }
  //Consultation
  function control_getClientSF(){
    $sql = new Client();
    $title = ''.$_SESSION['utilisateur'].'';
    ob_start();
    $table = 'client_total';
    $field = '*';
    $condition = 'Cli_SF = ?';
    $ordre = 'nomPrenoms';
    $data = array($_POST['statClient']);
    $req = $sql -> getClientParAgent($table, $field, $condition, $ordre, $data);
    if ($req -> rowCount() >= 1) {
      $ti = '';
      if ($data[0] == 'Oui') {
        $ti = '<h1 id="titre_tableau">Liste des clients Spéciale Fête</h1>';
      }else{
        $ti = '<h1 id="titre_tableau">Liste des clients Spéciale Pâques</h1>';
      }
      ?>
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
            <?=$ti ?>
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
        $nv = 200;
        $totalNV = 0;
        $totalMNT = 0;
        $table = '';
        if ($_SESSION['pseudo'] == 'admin' OR $_SESSION['pseudo'] == 'samfo16' OR $_SESSION['pseudo'] == 'kokossoumt') {
          while ($dt = $req -> fetch()) {
            if ($dt['statutClient'] == 'Nouveau') {
              echo '<tr><td class="num_icon"><a href="index.php?controller=control_delClient&amp;id='.$dt['id'].'&amp;name='.$dt['nomPrenoms'].'&amp;num='.$dt['phone'].'&amp;qtier='.$dt['qtier'].'&amp;obj='.$dt['objectif'].'&amp;agent='.$dt['agent'].'"><i>&cross;</i></a></td><td class="num_icon"><a href="index.php?controller=control_modiForm&amp;id='.$dt['id'].'&amp;name='.$dt['nomPrenoms'].'&amp;num='.$dt['phone'].'&amp;qtier='.$dt['qtier'].'&amp;obj='.$dt['objectif'].'&amp;nb_mise='.$dt['nbreMise'].'&amp;mise='.$dt['mise'].'&amp;mntMise='.$dt['mntMise'].'&amp;statut='.$dt['statutClient'].'&amp;sf='.$dt['Cli_SF'].'&amp;sp='.$dt['Cli_SP'].'&amp;nbreJours='.$dt['nbre_jours'].'"><i class="fa fa-pen"></i></a></td><td class="celcentre">'.$dt['id'].'</td><td>'.$dt['nomPrenoms'].'</td><td class="celcentre">'.$dt['phone'].'</td><td class="celcentre">'.$dt['qtier'].'</td><td>'.$dt['objectif'].'</td><td class="celcentre">'.$dt['nbreMise'].'</td><td class="celcentre">'.$dt['mise'].'</td><td class="celcentre">'.$dt['mntMise'].'</td><td class="celcentre">'.$nv.'</td><td class="celcentre">-</td><td class="celcentre">'.$dt['Cli_SF'].'</td><td class="celcentre">'.$dt['Cli_SP'].'</td><td class="celcentre">'.$dt['nbre_jours'].'</td></tr>';
              $totalNV += $nv;
            }else{
              echo '<tr><td class="num_icon"><a href="index.php?controller=control_delClient&amp;id='.$dt['id'].'&amp;name='.$dt['nomPrenoms'].'&amp;num='.$dt['phone'].'&amp;qtier='.$dt['qtier'].'&amp;obj='.$dt['objectif'].'&amp;agent='.$dt['agent'].'"><i>&cross;</i></a></td><td class="num_icon"><a href="index.php?controller=control_modiForm&amp;id='.$dt['id'].'&amp;name='.$dt['nomPrenoms'].'&amp;num='.$dt['phone'].'&amp;qtier='.$dt['qtier'].'&amp;obj='.$dt['objectif'].'&amp;nb_mise='.$dt['nbreMise'].'&amp;mise='.$dt['mise'].'&amp;mntMise='.$dt['mntMise'].'&amp;statut='.$dt['statutClient'].'&amp;sf='.$dt['Cli_SF'].'&amp;sp='.$dt['Cli_SP'].'&amp;nbreJours='.$dt['nbre_jours'].'"><i class="fa fa-pen"></i></a></td><td class="celcentre">'.$dt['id'].'</td><td>'.$dt['nomPrenoms'].'</td><td class="celcentre">'.$dt['phone'].'</td><td class="celcentre">'.$dt['qtier'].'</td><td>'.$dt['objectif'].'</td><td class="celcentre">'.$dt['nbreMise'].'</td><td class="celcentre">'.$dt['mise'].'</td><td class="celcentre">'.$dt['mntMise'].'</td><td class="celcentre"> - </td><td class="celcentre">&check;</td><td class="celcentre">'.$dt['Cli_SF'].'</td><td class="celcentre">'.$dt['Cli_SP'].'</td><td class="celcentre">'.$dt['nbre_jours'].'</td></tr>';
            }
            $totalMNT += $dt['mntMise'];
          }
        }else {
          if ($_SESSION['pseudo'] == 'secreSokomath') {
            //session secrétaire
            while ($dt = $req -> fetch()) {
              if ($dt['statutClient'] == 'Nouveau') {
                $table .= '<tr><td class="num_icon"><a href="index.php?controller=control_notAuthorized"><i>&cross;</i></a></td><td class="num_icon"><a href="index.php?controller=control_modiForm&amp;id='.$dt['id'].'&amp;name='.$dt['nomPrenoms'].'&amp;num='.$dt['phone'].'&amp;qtier='.$dt['qtier'].'&amp;obj='.$dt['objectif'].'&amp;nb_mise='.$dt['nbreMise'].'&amp;mise='.$dt['mise'].'&amp;mntMise='.$dt['mntMise'].'&amp;statut='.$dt['statutClient'].'&amp;sf='.$dt['Cli_SF'].'&amp;sp='.$dt['Cli_SP'].'"&amp;nbreJours='.$dt['nbre_jours'].'><i class="fa fa-pen"></i></a></td><td class="celcentre">'.$dt['id'].'</td><td>'.$dt['nomPrenoms'].'</td><td class="celcentre">'.$dt['phone'].'</td><td class="celcentre">'.$dt['qtier'].'</td><td>'.$dt['objectif'].'</td><td class="celcentre">'.$dt['nbreMise'].'</td><td class="celcentre">'.$dt['mise'].'</td><td class="celcentre">'.$dt['mntMise'].'</td><td class="celcentre">'.$nv.'</td><td class="celcentre">-</td><td class="celcentre">'.$dt['Cli_SF'].'</td><td class="celcentre">'.$dt['Cli_SP'].'</td><td class="celcentre">'.$dt['nbre_jours'].'</td></tr>';
                $totalNV += $nv;
              }else{
                $table .= '<tr><td class="num_icon"><a href="index.php?controller=control_notAuthorized"><i>&cross;</i></a></td><td class="num_icon"><a href="index.php?controller=control_modiForm&amp;id='.$dt['id'].'&amp;name='.$dt['nomPrenoms'].'&amp;num='.$dt['phone'].'&amp;qtier='.$dt['qtier'].'&amp;obj='.$dt['objectif'].'&amp;nb_mise='.$dt['nbreMise'].'&amp;mise='.$dt['mise'].'&amp;mntMise='.$dt['mntMise'].'&amp;statut='.$dt['statutClient'].'&amp;sf='.$dt['Cli_SF'].'&amp;sp='.$dt['Cli_SP'].'&amp;nbreJours='.$dt['nbre_jours'].'"><i class="fa fa-pen"></i></a></td><td class="celcentre">'.$dt['id'].'</td><td>'.$dt['nomPrenoms'].'</td><td class="celcentre">'.$dt['phone'].'</td><td class="celcentre">'.$dt['qtier'].'</td><td>'.$dt['objectif'].'</td><td class="celcentre">'.$dt['nbreMise'].'</td><td class="celcentre">'.$dt['mise'].'</td><td class="celcentre">'.$dt['mntMise'].'</td><td class="celcentre"> - </td><td class="celcentre">&check;</td><td class="celcentre">'.$dt['Cli_SF'].'</td><td class="celcentre">'.$dt['Cli_SP'].'</td><td class="celcentre">'.$dt['nbre_jours'].'</td></tr>';
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
                <?php
                  $table = 'client_total';
                  $field = 'id';
                  $reqm = $sql -> readMax($table, $field);
                  $dt = $reqm -> fetch();
                 ?>
                 <tr>
                   <td colspan="2" rowspan="2">Total</td>
                   <td rowspan="2"><?php echo $dt['id']; ?></td>
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
    }else {
      echo '<script type="text/javascript">alert("Aucun enregistrement ne répond à cette requête.")</script>';
    }
    $content = ob_get_clean();
    require('vue/template.php');
  }
  function control_consultPatAgent(){
    $sql = new Client();
    $title = ''.$_SESSION['utilisateur'].'';
    ob_start();
    $table = 'user';
    $field = '*';
    $ordre = 'nomPrenoms';
    $req = $sql -> getUsers($table, $field, $ordre);?>
    <h1>Liste des par rubrique</h1>
    <form class="listParAgent" action="index.php" method="post">
      <label for="agent">Imprimer la liste des clients:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
      <select class="" name="utilisateur">
        <option value="" disabled selected>Choisissez un agent</option>
        <?php
          while ($dt = $req -> fetch()) {
            if ($dt['pseudo'] != 'admin') {
              if ($dt['pseudo'] != 'samfo16') {
                if ($dt['pseudo'] != 'kokossoumt') {
                  echo '<option value="'.$dt['nomPrenoms'].'">'.$dt['nomPrenoms'].'&nbsp;&nbsp;&nbsp;'.$dt['contact'].'</option>';
                }
              }
            }
          }
         ?>
      </select>
      <input type="hidden" name="controller" value="control_getClientParAgent">
      <input type="submit" name="aff" value="Afficher">
    </form>
    <form class="listParAgent" action="index.php" method="post">
      <label for="agent">Liste des clients par option:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
      <select class="" name="statClient">
        <option value="" disabled selected>Choisissez la liste des clients</option>
        <option value="Oui">Spéciale Fête (SF)</option>
        <option value="Non">Spéciale Pâques (SP)</option>
      </select>
      <input type="hidden" name="controller" value="control_getClientSF">
      <input type="submit" name="listeCli" value="Afficher">
    </form>
    <form class="listParAgent" action="index.php" method="post">
      <label for="agent">Souhaitez-vous retirer un client ?</label>
      <select class="" name="agent">
        <option value="" disabled selected>Veuillez choisir son agent</option>
        <?php
        $table = 'user';
        $field = '*';
        $ordre = 'nomPrenoms';
        $req = $sql -> getUsers($table, $field, $ordre);
          while ($dt = $req -> fetch()) {
            if ($dt['pseudo'] != 'admin') {
              if ($dt['pseudo'] != 'samfo16') {
                if ($dt['pseudo'] != 'kokossoumt') {
                  echo '<option value="'.$dt['nomPrenoms'].'">'.$dt['nomPrenoms'].'&nbsp;&nbsp;&nbsp;'.$dt['contact'].'</option>';
                }
              }
            }
          }
         ?>
      </select>
      <input type="hidden" name="controller" value="control_suppresionParAgent">
      <input type="submit" name="listSupprClient" value="Afficher">
    </form>
    <?php
    $content = ob_get_clean();
    require('vue/template.php');
  }
  function control_getClientParAgent(){
    $sql = new Client();
    if (isset($_POST['aff'])) {
      if (!empty($_POST['utilisateur'])) {
        $table = 'client';
        $field = '*';
        $condition = 'agent = ?';
        $ordre = 'nomPrenoms';
        $data = array($_POST['utilisateur']);
        $req = $sql -> getClientParAgent($table, $field, $condition, $ordre, $data);
        $table = '';
        if ($req -> rowCount() >= 1) {
          while ($dt = $req -> fetch()) {
            $table .= '<tr><td style="outline: 1px solid black; font-size: 20px;">'.$dt['nomPrenoms'].'</td><td style="outline: 1px solid black; text-align: center; font-size: 20px;" class="celcentre">'.$dt['phone'].'</td><td style="outline: 1px solid black; text-align: center; font-size: 20px;" class="celcentre">'.$dt['qtier'].'</td><td style="outline: 1px solid black; font-size: 20px;">'.$dt['objectif'].'</td><td style="outline: 1px solid black; text-align: center; font-size: 20px;" class="celcentre">'.$dt['nbreMise'].'</td><td style="outline: 1px solid black; text-align: center; font-size: 20px;" class="celcentre">'.$dt['mise'].'</td><td style="outline: 1px solid black; text-align: center; font-size: 20px;" class="celcentre">'.$dt['mntMise'].'</td><td style="outline: 1px solid black; text-align: center; font-size: 20px;" class="celcentre"></td><td style="outline: 1px solid black; text-align: center; font-size: 20px;" class="celcentre"></td><td style="outline: 1px solid black; text-align: center; font-size: 20px;" class="celcentre">'.$dt['Cli_SF'].'</td><td style="outline: 1px solid black; text-align: center; font-size: 20px;" class="celcentre">'.$dt['Cli_SP'].'</td><td style="outline: 1px solid black; text-align: center; font-size: 20px;" class="celcentre">'.$dt['nbre_jours'].'</td></tr>';
          }
        }else{
          echo '<script type="text/javascript">alert(\'Aucun enregistrement trouvé\')</script>';
        }
      }
    }else {
      echo '<script type="text/javascript">alert(\'Aucun enregistrement ne répond en ce nom\')<script>';
    }
    require('vue/impr.php');
  }
  function control_suppresionParAgent(){
    $sql = new Client();
    $title = ''.$_SESSION['utilisateur'].'';
    ob_start();
    ?>
    <div class="liste">
      <div class="conteneur">
        <div class="titre">
          <h1 id="titre_tableau">Liste des clients par agent</h1>
        </div>
      </div>
      <div class="tableau">
         <table>
           <thead>
             <tr>
               <td rowspan="2" colspan="2" id="num">Numéro</td>
               <td rowspan="2" id="nomSupp">Nom et prénoms</td>
               <td rowspan="2" id="tel">Téléphone</td>
               <td rowspan="2" id="qtier">Quartier</td>
               <td rowspan="2" id="objSupp">Objectif</td>
               <td rowspan="2" id="nbreMise">Nom de l'agent</td>
             </tr>
           </thead>
           <tbody>
    <?php
      $table = 'client';
      $field = '*';
      $condition = 'agent = ?';
      $ordre ='nomPrenoms';
      $data = array($_POST['agent']);
      $req = $sql -> getClientParAgent($table, $field, $condition, $ordre, $data);
      $nv = 200;
      $totalNV = 0;
      $totalMNT = 0;
      $table = '';
      if ($req -> rowCount() >= 1) {
        if ($_SESSION['pseudo'] == 'admin' OR $_SESSION['pseudo'] == 'samfo16' OR $_SESSION['pseudo'] == 'kokossoumt') {
          while ($dt = $req -> fetch()) {
            echo '<tr><td class="num_icon"><a href="index.php?controller=delClientFrosupprPAgent&amp;id='.$dt['id'].'&amp;name='.$dt['nomPrenoms'].'&amp;num='.$dt['phone'].'&amp;qtier='.$dt['qtier'].'&amp;obj='.$dt['objectif'].'&amp;agent='.$dt['agent'].'"><i>&cross;</i></a></td><td class="celcentre">'.$dt['id'].'</td><td>'.$dt['nomPrenoms'].'</td><td class="celcentre">'.$dt['phone'].'</td><td class="celcentre">'.$dt['qtier'].'</td><td>'.$dt['objectif'].'</td><td class="celcentre">'.$dt['agent'].'</td></tr>';
          }
        }else {
          while ($dt = $req -> fetch()) {
            $table .= '<tr><td class="num_icon"><a href="index.php?controller=control_notAuthorized"><i>&cross;</i></a></td><td class="celcentre">'.$dt['id'].'</td><td>'.$dt['nomPrenoms'].'</td><td class="celcentre">'.$dt['phone'].'</td><td class="celcentre">'.$dt['qtier'].'</td><td>'.$dt['objectif'].'</td><td class="celcentre">'.$dt['agent'].'</td></tr>';
          }
          echo $table;
        }
      }else {
        echo '<script type="text/javascript">alert(\'Aucun enregistrement trouvé\')</script>';
      }
      ?>
            </tbody>
          </table>
        </div>
        </div>
    <?php
    $content = ob_get_clean();
    require('vue/template.php');
  }
  function control_consultation(){
    $sql = new Client();
    require('vue/consultation.php');
  }
  //modification form
  function control_modiForm(){
    $sql = new Client();
    require('vue/modification.php');
  }
  //suppression
  function control_delClient(){
    $sql = new Client();
    if (isset($_GET['id'])) {
        //add to trash
        $table = 'trash';
        $field = 'nomPrenoms_trash, phone_trash, qtier_trash';
        $value = '?, ?, ?';
        $data = array($_GET['name'], $_GET['num'], $_GET['qtier']);
        $req = $sql -> insertIntoTrash($table, $field, $value, $data);
        //add to history
        $table = 'historique';
        $field = 'date, motif, entree, sortie, agent';
        $value = '?, ?, ?, ?, ?';
        $motif = 'Suppression pour '.$_GET['name'].'';
        $montMise = $_GET['mnt'] + $_GET['stat'];
        $jour = ''.date('Y').'-'.date('m').'-'.date('d').'';
        $data = array($jour, $motif, 0, $montMise, $_GET['agent']);
        $sql -> addClient($table, $field, $value, $data);
        //delete from client_total
        $table = 'client_total';
        $condition = 'id = ?';
        $data = array($_GET['id']);
        $req = $sql -> delClient($table, $condition, $data);
        echo '<script type="text/javascript">alert(\'Suppression réussie.\')</script>';
        header("Location:index.php?controller=control_consultation");
    }
  }
  function delClientFrosupprPAgent(){
    $sql = new Client();
    if (isset($_GET['id'])) {
      $table = 'client';
      $condition = 'id = ?';
      $agent = $_GET['agent'];
      $data = array($_GET['id']);
      $req = $sql -> delClient($table, $condition, $data);
      echo '<script type="text/javascript">alert(\'Suppression réussie.\')</script>';
      header('Location:index.php?controller=control_consultPatAgent');
    }
  }
  function control_delUsers(){
    $sql = new Client();
    if (isset($_GET['id'])) {
      $table = 'user';
      $condition = 'id = ?';
      $data = array($_GET['id']);
      $req = $sql -> delClient($table, $condition, $data);
      echo '<script type="text/javascript">alert(\'Suppression réussie.\')</script>';
    }
    header("Location:index.php?controller=control_parameter");
  }
  //inscriptioin
  function control_inscription(){
    $sql = new Client();
    if (isset($_POST['valider'])) {
      if (!empty($_POST['nomPrenom']) AND !empty($_POST['telephone']) AND !empty($_POST['qtier']) AND !empty($_POST['obj']) AND !empty($_POST['nb_mise'])  AND !empty($_POST['mise'])  AND !empty($_POST['stat_client'])  AND !empty($_POST['cliSF'])  AND !empty($_POST['cliSP'])){
        $table = 'client';
        $field = 'nomPrenoms, phone, qtier, objectif, nbreMise, mise, mntMise, statutClient, Cli_SF, Cli_SP, nbre_jours, agent, date';
        $value = '?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?';
        $montMise = $_POST['nb_mise'] * $_POST['mise'];
        $data = array($_POST['nomPrenom'], $_POST['telephone'], $_POST['qtier'], $_POST['obj'], '', $_POST['mise'], '' , '', '', '', '', $_POST['nomAgent'], $_POST['jour']);
        $sql -> addClient($table, $field, $value, $data);
        $table = 'client_total';
        $field = 'nomPrenoms, phone, qtier, objectif, nbreMise, mise, mntMise, statutClient, Cli_SF, Cli_SP, nbre_jours, agent, date';
        $value = '?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?';
        $montMise = $_POST['nb_mise'] * $_POST['mise'];
        $data = array($_POST['nomPrenom'], $_POST['telephone'], $_POST['qtier'], $_POST['obj'], $_POST['nb_mise'], $_POST['mise'], $montMise , $_POST['stat_client'], $_POST['cliSF'], $_POST['cliSP'], $_POST['nbreJours'], $_POST['nomAgent'], $_POST['jour']);
        $sql -> addClient($table, $field, $value, $data);
        $table = 'historique';
        $field = 'date, motif, entree, sortie, agent';
        $value = '?, ?, ?, ?, ?';
        $motif = 'Inscription pour '.$_POST['nomPrenom'].'';
        $data = array($_POST['jour'], $motif, $montMise, 0, $_POST['nomAgent']);
        $sql -> addClient($table, $field, $value, $data);
        echo '<script type="text/javascript">alert("La requête d\'ajout à bien été prise en compte.")</script>';
      }else{
        echo '<script type="text/javascript">alert("Veuillez renseigner les champs vides")</script>';
      }
    }
    require('vue/inscription.php');
  }
  //modification
  function control_modification(){
    $sql = new Client();
    if (isset($_POST['modifier'])) {
      if (!empty($_POST['nomPrenom']) AND !empty($_POST['telephone']) AND !empty($_POST['qtier']) AND !empty($_POST['obj']) AND !empty($_POST['nb_mise'])  AND !empty($_POST['mise'])  AND !empty($_POST['stat_client'])  AND !empty($_POST['cliSF'])  AND !empty($_POST['cliSP']) AND !empty($_POST['nomAgent'])){
        //modifier dans la table cleint_total
        $table = 'client_total';
        $field = 'nomPrenoms = ?, phone = ?, qtier = ?, objectif = ?, nbreMise = ?, mise = ?, mntMise = ?, statutClient = ?, Cli_SF = ?, Cli_SP = ?, nbre_jours = ?, agent = ?';
        $condition = 'id = ?';
        $montMise = $_POST['nb_mise'] * $_POST['mise'];
        $data = array($_POST['nomPrenom'], $_POST['telephone'], $_POST['qtier'], $_POST['obj'], $_POST['nb_mise'], $_POST['mise'], $montMise, $_POST['stat_client'], $_POST['cliSF'], $_POST['cliSP'], $_POST['nbreJours'], $_POST['nomAgent'], $_POST['numInscrip']);
        $sql -> updateClient($table, $field, $condition, $data);
        //ajouter dans l'historique
        $table = 'historique';
        $field = 'date, motif, entree, sortie, agent';
        $value = '?, ?, ?, ?, ?';
        $motif = 'Modifié pour '.$_POST['nomPrenom'].'';
        $dateDuJour = '';
        if (!empty($_POST['jour']) AND $_POST['jour'] != $_SESSION['dateCourante']) {
          $dateDuJour = $_POST['jour'];
        }else {
          $dateDuJour = ''.date('Y').'-'.date('m').'-'.date('d').'';
        }
        $data = array($dateDuJour, $motif, $montMise - $_SESSION['MiseTT'], 0, $_POST['nomAgent']);
        $req = $sql -> addClient($table, $field, $value, $data);
        echo '<script type="text/javascript">alert(\'Modification réussie.\')</script>';
        header('Location:index.php?controller=control_consultation');
      }else{
        echo '<script type="text/javascript">alert(\'Renseignez les champs vides.\')</script>';
        header('Location:index.php?controller=control_consultation');
      }
    }
  }
  function control_updateUsers(){
    $sql = new Client();
    if (isset($_POST['bouton'])) {
      if (!empty($_POST['nom']) AND !empty($_POST['email']) AND !empty($_POST['pseudo']) AND !empty($_POST['password'])){
        $ident = htmlspecialchars($_POST['identite']);
        $nom = htmlspecialchars($_POST['nom']);
        $mail = htmlspecialchars($_POST['email']);
        $tel = htmlspecialchars($_POST['contact']);
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $passwd = htmlspecialchars($_POST['password']);
        $passwd = hash('sha256', $passwd);
        //echo ''.$ident.''.$nom.'/'.$mail.'/'.$tel.'/'.$pseudo.'/'.$passwd.'';
        $table = 'user';
        $field = 'nomPrenoms = ?, contact = ?, mail = ?, pseudo = ?, password = ?';
        $condition = 'id = ?';
        $data = array($nom, $tel, $mail, $pseudo, $passwd, $ident);
        $req = $sql -> updateUsers($table, $field, $condition, $data);
        echo '<script type="text/javascript">alert(\'Modification réussie.\')</script>';
        header('Location:index.php?controller=control_parameter');
      }else{
        echo '<script type="text/javascript">alert(\'Renseignez les champs vides.\')</script>';
      }
    }
    require('vue/upUsers.php');
  }
  //recherche
  function control_recherche(){
    $sql = new Client();
    require('vue/resultRecherche.php');
  }
  //parameters
  function control_parameter(){
    $sql = new Client();
    require('vue/parameters.php');
  }
  //connexion & decconexion
  function control_login(){
    $sql =  new Client();
    if (isset($_POST['bouton'])) {
      if (isset($_POST['pseudo']) AND isset($_POST['password'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $passwd = htmlspecialchars($_POST['password']);
        $table = 'user';
        $field = '*';
        $condition = 'pseudo = ?';
        $data = array($pseudo);
        $req = $sql -> checkUser($table, $field, $condition, $data);
        $dt = $req -> fetch();
        $row = $req -> rowCount();
        if ($row == 1) {
          if ($pseudo == $dt['pseudo']) {
            $passwd = hash('sha256', $passwd);
            $ip = $_SERVER['REMOTE_ADDR'];//addresse ip
            if ($passwd == $dt['password']) {
              $_SESSION['utilisateur'] = $dt['nomPrenoms'];
              $_SESSION['mail'] = $dt['mail'];
              $_SESSION['pseudo'] = $dt['pseudo'];
              $_SESSION['login_time'] = time();
              header('Location:index.php?controller=control_home');
            }else{header('Location:index.php?login_err=password');}
          }else{header('Location:index.php?login_err=pseudo');}
        }else{header('Location:index.php?login_err=already');}
      }else{header('Location:index.php');}
    }
    if (isset($_GET['login_err'])) {
      $login_err = htmlspecialchars($_GET['login_err']);
      switch ($login_err) {
        case 'password':
          ?>
            <style>
              .alert{
                z-index: 2;
                border-radius: 10px;
                width: 440px;
                margin: 0 auto;
                font-size: 20px;
                background-color: rgb(255, 190, 180);
                line-height: 60px;
                padding-left: 15px;
              }
              .alert-danger{
                color: rgb(190, 80, 70);
              }
            </style>
            <div class="alert alert-danger">
              <strong>Erreur</strong> mot de passe incorrect
            </div>
          <?php
          break;
        case 'pseudo':
          ?>
            <style>
              .alert{
                z-index: 2;
                border-radius: 15px;
                width: 440px;
                margin: 0 auto;
                font-size: 20px;
                background-color: rgb(255, 190, 180);
                line-height: 60px;
                padding-left: 15px;
              }
              .alert-danger{
                color: rgb(190, 80, 70);
              }
            </style>
            <div class="alert alert-danger">
              <strong>Erreur</strong> pseudo incorrect
            </div>
          <?php
          break;
        case 'already':
          ?>
            <style>
              .alert{
                z-index: 2;
                border-radius: 15px;
                width: 440px;
                margin: 0 auto;
                font-size: 20px;
                background-color: rgb(255, 190, 180);
                line-height: 60px;
                padding-left: 15px;
              }
              .alert-danger{
                color: rgb(190, 80, 70);
              }
            </style>
            <div class="alert alert-danger">
              <strong>Erreur</strong> compte non existant
            </div>
          <?php
          break;
      }
    }
    require('vue/login.php');
  }
  function control_home(){
    require('vue/home.php');
  }
  function control_logout(){
    session_destroy();
    header('Location:index.php');
  }
 ?>
