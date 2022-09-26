<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Impression</title>
    <link rel="shortcut icon" href="vue/img/icon.jpg" type="image/x-icon">
    <meta charset="utf-8">
    <link rel="stylesheet" href="public/ui.css">
    <style media="screen">
      body{
        background-color: #fff;
      }
    </style>
    <script type="text/javascript">
      function printContent(el){
        var restore = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restore;
      }
    </script>
  </head>
  <body>
    <div id="imprTable">
      <table>
        <caption style="font-size: 35px; font-weight: bold;">ETS SOKOMATH SERVICES</caption>
        <thead style="font-weight: bold;">
          <tr>
            <?php
              $tableReq = 'user';
              $field = 'contact';
              $condition = 'nomPrenoms = \''.$_POST['utilisateur'].'\'';
              $req = $sql -> getContactUser($tableReq, $field, $condition);
              $don = $req -> fetch();
             ?>
            <td rowspan="2" style="outline: 1px solid black;">Agent Commercial</td>
            <td rowspan="2" colspan="8" style="outline: 1px solid black; text-align: center; font-size: 20px;"><?=$_POST['utilisateur']?></td>
            <td colspan="3" style="outline: 1px solid black;">Contact : <?=$don['contact'];?></td>
          </tr>
          <tr>
            <td colspan="3" style="outline: 1px solid black;">Date : <?=date('d').' '.date('M').' '.date('Y').'  '.date('H').':'.date('i').':'.date('s'); ?></td>
          </tr>
          <tr>
            <td colspan="14" style="outline: 1px solid black; text-align: center; font-size: 20px;">FICHE DE SUIVI QUOTIDIENT DE L'AGENT(toutes les cases doivent obligatoirement être remplies)</td>
          </tr>
          <tr >
            <td style="outline: 1px solid black; text-align: center; font-size: 15px;" rowspan="2" id="nom">Nom et prénoms</td>
            <td style="outline: 1px solid black; text-align: center; font-size: 15px;" rowspan="2" id="tel">Téléphone</td>
            <td style="outline: 1px solid black; text-align: center; font-size: 15px;" rowspan="2" id="qtier">Quartier</td>
            <td style="outline: 1px solid black; text-align: center; font-size: 15px;" rowspan="2" id="obj">Objectif</td>
            <td style="outline: 1px solid black; text-align: center; font-size: 15px;" rowspan="2" id="nbreMise">Nombre de Mise</td>
            <td style="outline: 1px solid black; text-align: center; font-size: 15px;" rowspan="2" id="mise">Mise (F CFA)</td>
            <td style="outline: 1px solid black; text-align: center; font-size: 15px;" rowspan="2" id="montMise">Montant de la mise (F CFA)</td>
            <td style="outline: 1px solid black; text-align: center; font-size: 15px;" colspan="2" id="statCli">Statut Client</td>
            <td style="outline: 1px solid black; text-align: center; font-size: 15px;" rowspan="2" id="cliSF">Client Spéciale Fête</td>
            <td style="outline: 1px solid black; text-align: center; font-size: 15px;" rowspan="2" id="cliSP">Client Spéciale Pâques</td>
            <td style="outline: 1px solid black; text-align: center; font-size: 15px;" rowspan="2" id="nbreJours">Nombre de jours</td>
          </tr>
          <tr>
            <td style="outline: 1px solid black; text-align: center; font-size: 15px;">Nouveau</td>
            <td style="outline: 1px solid black; text-align: center; font-size: 15px;">Ancien</td>
          </tr>
        </thead>
        <tbody>
          <?=$table ?>
          <tr>
            <td style="outline: 1px solid black; font-weight: bold; text-align: center; font-size: 20px;" rowspan="4">Total</td>
            <td style="outline: 1px solid black; font-weight: bold; text-align: center; font-size: 20px;">Mise</td>
            <td style="outline: 1px solid black; font-weight: bold; text-align: center; font-size: 20px;"></td>
          </tr>
          <tr>
            <td style="outline: 1px solid black; font-weight: bold; text-align: center; font-size: 20px;">Cartes vendues</td>
            <td style="outline: 1px solid black; font-weight: bold; text-align: center; font-size: 20px;"></td>
          </tr>
          <tr>
            <td style="outline: 1px solid black; font-weight: bold; text-align: center; font-size: 20px;">Déplacement</td>
            <td style="outline: 1px solid black; font-weight: bold; text-align: center; font-size: 20px;"></td>
          </tr>
          <tr>
            <td style="outline: 1px solid black; font-weight: bold; text-align: center; font-size: 20px;">Solde</td>
            <td style="outline: 1px solid black; font-weight: bold; text-align: center; font-size: 20px;"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <button type="button" name="button" onclick="printContent('imprTable')">Imprimer</button>
  </body>
</html>
