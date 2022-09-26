<?php
$title = 'Modification';
ob_start();
?>
<form action="index.php" method="post">
  <fieldset class="inscrip">
      <legend>Formulaire de modification</legend>
      <fieldset class="client">
          <legend>Informations Client</legend>
          <table>
              <tr>
                  <td><label for="num">Numéro</label></td>
                  <td><input type="text" name="numInscrip" min="0" value="<?php echo $_GET['id'] ?>" id="numInscrip"></td>
              </tr>
              <tr>
                  <td><label for="nomPrenom">Nom et Prénom (s)</label></td>
                  <td><input type="text" name="nomPrenom" required value="<?php echo $_GET['name'] ?>" placeholder="Nom et Prénom(s)">&nbsp;<strong style="color: red">*</strong></td>
              </tr>
              <tr>
                  <td><label for="telephone">Téléphone</label></td>
                  <td><input type="tel" name="telephone" required value="<?php echo $_GET['num'] ?>" placeholder="Téléphone" maxlength="8">&nbsp;<strong style="color: red">*</strong></td>
              </tr>
              <tr>
                  <td><label for="qtier">Quartier (Domicile)</label></td>
                  <td><input type="text" name="qtier" required value="<?php echo $_GET['qtier'] ?>" placeholder="Quartier">&nbsp;<strong style="color: red">*</strong></td>
              </tr>
              <tr>
                <td><label for="nb_jour">Nom de l'agent</label></td>
                <td>
                  <?php
                  $table = 'user';
                  $field = '*';
                  $ordre = 'nomPrenoms';
                  $req = $sql -> getUsers($table, $field, $ordre);
                   ?>
                  <select class="listParAgent" name="nomAgent">
                    <option value="" disabled selected>Choisissez un agent</option>
                    <?php
                    while ($dt = $req -> fetch()) {
                      if ($dt['pseudo'] != 'admin') {
                        if ($dt['pseudo'] != 'samfo16') {
                          if ($dt['pseudo'] != 'kokossoumt') {
                            if ($_GET['agent'] == $dt['nomPrenoms']) {
                              echo '<option value="'.$dt['nomPrenoms'].'" selected>'.$dt['nomPrenoms'].'&nbsp;&nbsp;&nbsp;'.$dt['contact'].'</option>';
                            }else {
                              echo '<option value="'.$dt['nomPrenoms'].'">'.$dt['nomPrenoms'].'&nbsp;&nbsp;&nbsp;'.$dt['contact'].'</option>';
                            }
                          }
                        }
                      }
                    }
                     ?>
                  </select>
                </td>
              </tr>
          </table>
      </fieldset>
      <fieldset class="tontine">
          <legend>Informations Adogbè</legend>
          <table>
              <tr>
                  <td><label for="obj">Objectif</label></td>
                  <td colspan="5"><input type="text" name="obj" required value="<?php echo $_GET['obj'] ?>" placeholder="Objectif">&nbsp;<strong style="color: red">*</strong></td>
              </tr>
              <tr>
                  <td><label for="nb_mise">Nombre de mise</label></td>
                  <td colspan="2"><input type="number" name="nb_mise" value="<?php echo $_GET['nb_mise'] ?>" min="1"></td>
                  <!--deuxième lot de colonne-->
                  <td><label for="duree_contrat">Client Spéciale Fête ?</label></td>
                  <td>
                    <select class="selection" name="cliSF">
                      <option disabled selected>Opérez un choix</option>
                      <?php if ($_GET['sf'] == 'Oui'): ?>
                        <option value="Oui" selected>Oui</option>
                        <option value="Non">Non</option>
                      <?php else: ?>
                        <option value="Oui">Oui</option>
                        <option value="Non" selected>Non</option>
                      <?php endif; ?>
                    </select>
                  </td>
              </tr>
              <tr>
                  <td><label for="mont_mise">Mise</label></td>
                  <td colspan="2"><input type="number" name="mise" value="<?php echo $_GET['mise'] ?>" placeholder="Montant de la mise" min="25"></td>
                  <?php $_SESSION['MiseTT'] = $_GET['mise'] * $_GET['nb_mise'];?>
                  <!--deuxième lot de colonne-->
                  <td><label for="duree_contrat">Client Spéciale Pâques ?</label></td>
                  <td>
                    <select class="selection" name="cliSP">
                      <option disabled selected>Opérez un choix</option>
                      <?php if ($_GET['sp'] == 'Oui'): ?>
                        <option value="Oui" selected>Oui</option>
                        <option value="Non">Non</option>
                      <?php else: ?>
                        <option value="Oui">Oui</option>
                        <option value="Non" selected>Non</option>
                      <?php endif; ?>
                    </select>
                  </td>
              </tr>
              <tr>
                  <td><label for="cliSP">Statut du client</label></td>
                  <td colspan="2">
                    <select class="selection" name="stat_client">
                      <option disabled selected>Opérez un choix</option>
                      <?php if ($_GET['statut'] == 'Nouveau'): ?>
                        <option value="Nouveau" selected>Nouveau</option>
                        <option value="Ancien">Ancien</option>
                      <?php else: ?>
                        <option value="Nouveau">Nouveau</option>
                        <option value="Ancien" selected>Ancien</option>
                      <?php endif; ?>
                    </select>
                  </td>
                  <!--deuxième lot de colonne-->
                  <td>Nombre de jours</td>
                  <td><input type="number" name="nbreJours" value="<?=$_GET['nbreJours']?>" placeholder="Nombre de jours"/></td>
              </tr>
              <tr>
                <td><label for="date">Date</label></td>
                <td colspan="2"><input type="date" name="jour" value=<?=$_GET['date']?> max="<?=date('Y').'-'.date('m').'-'.date('d').''?>"></td>
                <?php $_SESSION['dateCourante'] = $_GET['date']; echo $_SESSION['dateCourante']; ?>
                <td><input type="hidden" name="controller" value="control_modification"></td>
                <td><input type="submit" name="modifier" value="Modifier"></td>
              </tr>
          </table>
      </fieldset>
    </fieldset>
</form>
<?php
$content = ob_get_clean();
require('template.php');?>
