<?php
  $title = 'Inscription';
  ob_start();
?>
<h1>Inscription</h1>
<form action="index.php" method="post">
<fieldset class="inscrip">
    <legend>Formulaire d'inscription</legend>
    <fieldset class="client">
        <legend>Informations Client</legend>
        <table>
            <tr>
                <td><label for="nomPrenom">Nom et Prénom (s)</label></td>
                <td><input type="text" name="nomPrenom" required placeholder="Nom et Prénom(s)">&nbsp;<strong style="color: red">*</strong></td>
            </tr>
            <tr>
                <td><label for="telephone">Téléphone</label></td>
                <td><input type="tel" name="telephone" required placeholder="Téléphone" maxlength="8">&nbsp;<strong style="color: red">*</strong></td>
            </tr>
            <tr>
                <td><label for="qtier">Quartier (Domicile)</label></td>
                <td><input type="text" name="qtier" required placeholder="Quartier">&nbsp;<strong style="color: red">*</strong></td>
            </tr>
            <tr>
              <td><label for="nomAgent">Nom de l'agent</label></td>
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
                          echo '<option value="'.$dt['nomPrenoms'].'">'.$dt['nomPrenoms'].'&nbsp;&nbsp;&nbsp;'.$dt['contact'].'</option>';
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
                <td colspan="5"><input type="text" name="obj" required placeholder="Objectif">&nbsp;<strong style="color: red">*</strong></td>
            </tr>
            <tr>
                <td><label for="nb_mise">Nombre de mise</label></td>
                <td colspan="2"><input type="number" name="nb_mise" min="1"></td>
                <!--deuxième lot de colonne-->
                <td><label for="duree_contrat">Client Spéciale Fête ?</label></td>
                <td>
                  <select class="selection" name="cliSF">
                    <option disabled selected>Opérez un choix</option>
                    <option value="Oui">Oui</option>
                    <option value="Non">Non</option>
                  </select>
                </td>
            </tr>
            <tr>
                <td><label for="mont_mise">Mise</label></td>
                <td colspan="2"><input type="number" name="mise" placeholder="Montant de la mise" min="25"></td>
                <!--deuxième lot de colonne-->
                <td><label for="duree_contrat">Client Spéciale Pâques ?</label></td>
                <td>
                  <select class="selection" name="cliSP">
                    <option disabled selected>Opérez un choix</option>
                    <option value="Oui">Oui</option>
                    <option value="Non">Non</option>
                  </select>
                </td>
            </tr>
            <tr>
                <td><label for="cliSP">Statut du client</label></td>
                <td colspan="2">
                  <select class="selection" name="stat_client">
                    <option disabled selected>Opérez un choix</option>
                    <option value="Nouveau">Nouveau</option>
                    <option value="Ancien">Ancien</option>
                  </select>
                </td>
                <!--deuxième lot de colonne-->
                <td>Nombre de jours</td>
                <td><input type="number" name="nbreJours" placeholder="Nombre de jours"/></td>
            </tr>
            <tr>
              <td><label for="date">Date</label></td>
              <td colspan="2"><input type="date" name="jour" max="<?=date('Y').'-'.date('m').'-'.date('d').''?>"></td>
              <td colspan="2"><input type="hidden" name="controller" value="control_inscription">
              <input type="submit" name="valider" value="Valider"></td>
            </tr>
        </table>
    </fieldset>
  </fieldset>
  <p>Tous les champs portant <strong style="color: red">*</strong> sont obligatoires</p>
</form>
<?php
  $content = ob_get_clean();
  require('template.php');
 ?>
