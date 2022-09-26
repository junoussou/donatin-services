<?php ob_start(); ?>
<h1>Historique</h1><br>
<table class="tableHist">
  <tr>
    <td>
      <form class="" action="index.php" method="get">
        <fieldset>
          <?php
          $table = 'user';
          $field = '*';
          $ordre = 'nomPrenoms';
          $req = $sql -> getUsers($table, $field, $ordre);
           ?>
          <legend>Renseignez les informations du formulaire comme convenu</legend>
          <label for="nameAgent">
            A la date du <strong><?=date('d').' '.date('M').' '.date('Y').''; ?></strong>, l'agent
            <select class="selectAgent" name="nameAgent">
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
            </select><br>à reçu :
          </label>
          <input type="number" name="salaire" min="500"><strong>F CFA</strong>.
          <input type="hidden" name="controller" value="control_addSalaire">
          <input type="submit" name="enregSalaire" value="Enregistrer">
        </fieldset>
      </form>
    </td>
    <td>
      <form class="" action="index.php" method="get">
        <fieldset>
          <legend>Connexion / Carburant des agents</legend>
          <label for="motifHis">Motif :
            <select class="motifHis" name="motifHis">
              <option disabled selected>Choisissez le motif</option>
              <optgroup label="Carburant">
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
              </optgroup>
              <option value="Connexion">Connexion</option>
            </select>
          </label>&nbsp;&nbsp;&nbsp;&nbsp;
          <label for="">Date : </label>
          <input type="date" name="dateCarbuConn" value="" max="<?=date('Y').'-'.date('m').'-'.date('d').''?>"><br>
          <label for="montantHis">Montant : </label>
          <input type="number" name="montantHis" value="" min="100"><strong>F CFA</strong>
          <input type="hidden" name="controller" value="control_carburanConnexion">
          <input type="submit" name="enregis" value="Enregistrer">
        </fieldset>
      </form>
    </td>
  </tr>
  <tr>
    <td>
      <form class="histPeri" action="index.php" method="get">
        <fieldset>
          <legend>Historique par agent</legend>
          <label for="nomAgent">Nom de l'agent</label>
          <?php
          $table = 'user';
          $field = '*';
          $ordre = 'nomPrenoms';
          $req = $sql -> getUsers($table, $field, $ordre);
           ?>
          <select class="selectAgent" name="nomAgent">
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
          </select><br><br>
          <label for="debut">De</label>
          <input type="date" name="dateDebutAgent" max="<?=date('Y').'-'.date('m').'-'.date('d').''?>">&nbsp;&nbsp;
          <label for="debut">à</label>
          <input type="date" name="dateFinAgent" max="<?=date('Y').'-'.date('m').'-'.date('d').''?>">&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="hidden" name="controller" value="control_historyParAgent">
          <input type="submit" name="validEnvoyAgent" value="Afficher">
        </fieldset>
      </form>
    </td>
    <td>
      <form class="histPeri" action="index.php" method="get">
        <fieldset>
          <legend>Historique Agence</legend>
          <label for="debut">De</label>
          <input type="date" name="dateDebut" max="<?=date('Y').'-'.date('m').'-'.date('d').''?>">&nbsp;&nbsp;
          <label for="debut">à</label>
          <input type="date" name="dateFin" max="<?=date('Y').'-'.date('m').'-'.date('d').''?>">&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="hidden" name="controller" value="control_history">
          <input type="submit" name="validEnvoy" value="Afficher">
        </fieldset>
      </form>
    </td>
  </tr>
</table><br>
<table class="hist">
  <thead>
    <tr>
      <td class="peri">Date</td>
      <td>Motif</td>
      <td>Entrée</td>
      <td>Sortie</td>
      <td>Agent</td>
    </tr>
  </thead>
  <tbody>
    <?php
    $result = '';
    $sql = new Client();
    $table = 'historique';
    $field = '*';
    $ordre ='id';
    $ttentrant = '';
    $ttsortant = '';
    $req = $sql -> readClient($table, $field, $ordre);
    if ($req -> rowCount() >= 1) {
      while ($dt = $req -> fetch()) {
        $result .= '<tr><td>'.$dt['date'].'</td><td>'.$dt['motif'].'</td><td>'.$dt['entree'].'</td><td>'.$dt['sortie'].'</td><td>'.$dt['agent'].'</td></tr>';
        $ttentrant += $dt['entree'];
        $ttsortant += $dt['sortie'];
      }
      $result .= '<tr><td colspan="2" rowspan="2">Total</td><td>'.$ttentrant.'</td><td>'.$ttsortant.'</td><td rowspan="2">-</td></tr>';
      $ttTotal = $ttentrant - $ttsortant;
      $result .= '<tr><td colspan="2">'.$ttTotal.'</td></tr>';
    }
    if (isset($_GET['validEnvoy']) OR isset($_GET['validEnvoyAgent'])) {
      echo $resultget;
    }else {
      echo $result;
    }
     ?>
  </tbody>
</table>
<?php
  $content = ob_get_clean();
  require('template.php');
?>
