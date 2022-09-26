<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <link rel="shortcut icon" href="vue/img/icon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="public/style_log.css">
  </head>
  <body>
    <div class="login-form">
      <?php
        if (isset($_GET['reg_err'])) {
        $reg_err = htmlspecialchars($_GET['reg_err']);
          switch ($reg_err) {
            case 'success':
              ?>
              <div class="alert alert-success">
                <strong>Succès</strong> inscription réussie
              </div>
              <?php
              break;
            case 'password':
              ?>
              <div class="alert alert-danger">
                <strong>Erreur</strong> mot de passe différent
              </div>
              <?php
              break;
            case 'email':
              ?>
              <div class="alert alert-danger">
                <strong>Erreur</strong> email non valide
              </div>
              <?php
              break;
            case 'email_length':
              ?>
              <div class="alert alert-danger">
                <strong>Erreur</strong> email trop long
              </div>
              <?php
              break;
            case 'pseudo_length':
              ?>
              <div class="alert alert-danger">
                <strong>Erreur</strong> pseudo trop long
              </div>
              <?php
              break;
            case 'already':
              ?>
              <div class="alert alert-danger">
                <strong>Erreur</strong> compte déjà existant
              </div>
              <?php
              break;
          }
        }
       ?>
      <form action="inscrip_log.php" method="post">
        <h1 class="title_log">SOKOMATH Service</h1>
        <h2 class="text-center">Inscription</h2>
        <div class="form-group">
          <input type="text" name="nom" class="form-control" placeholder="Nom et Prénoms" required autocomplete="off">
        </div>
        <div class="form-group">
          <input type="mail" name="email" class="form-control" placeholder="Adresse E-mail" required autocomplete="off">
        </div>
        <div class="form-group">
          <input type="phone" name="contact" class="form-control" placeholder="Numéro de téléphone" required autocomplete="off" maxlength="8">
        </div>
        <div class="form-group">
          <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" required autocomplete="off">
        </div>
        <div class="form-group">
          <input type="password" name="password" class="form-control" placeholder="Mot de passe" required autocomplete="off">
        </div>
        <div class="form-group">
          <input type="password" name="retype_password" class="form-control" placeholder="Confirmez le mot de passe" required autocomplete="off">
        </div>
        <div class="form-group">
          <input type="hidden" name="controller" value="control_inscrip_log">
          <button type="submit" name="bouton" class="btn btn-primary btn-block">S'inscrire</button>
        </div>
        <p class="text-center">Vous avez déjà compte ? <a href="index.php">Connectez-vous ici</a>.</p>
      </form>
    </div>
    <?php
      require('model.php');
      $sql = new Client();
      if (isset($_POST['bouton'])) {
        if (!empty($_POST['nom']) AND !empty($_POST['email']) AND !empty($_POST['pseudo']) AND !empty($_POST['password']) AND !empty($_POST['retype_password'])) {
          $nom = htmlspecialchars($_POST['nom']);
          $mail = htmlspecialchars($_POST['email']);
          $tel = htmlspecialchars($_POST['contact']);
          $pseudo = htmlspecialchars($_POST['pseudo']);
          $passwd = htmlspecialchars($_POST['password']);
          $password_retype = htmlspecialchars($_POST['retype_password']);
          //vérifier s'il existe
          $table = 'user';
          $field = '*';
          $condition = 'pseudo = ?';
          $data = array($pseudo);
          $req = $sql -> checkUser($table, $field, $condition, $data);
          $dt = $req -> fetch();
          $row = $req -> rowCount();
          if ($row == 0) {
            if (strlen($pseudo) <= 30) {
              if (strlen($mail) <= 50) {
                if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                  if ($passwd == $password_retype) {
                    $passwd = hash('sha256', $passwd);
                    $table = 'user';
                    $field = 'nomPrenoms, mail, contact, pseudo, password';
                    $value = '?, ?, ?, ?, ?';
                    $data = array($nom, $mail, $tel, $pseudo, $passwd);
                    $req = $sql -> addUser($table, $field, $value, $data);
                    header('Location:inscrip_log.php?rer_err=success');
                  }else {header('Location:inscrip_log.php?reg_err=password');}
                }else {header('Location:inscrip_log.php?reg_err=email');}
              }else {header('Location:inscrip_log.php?reg_err=email_length');}
            }else {header('Location:inscrip_log.php?reg_err=pseudo_length');}
          }else {header('Location:inscrip_log.php?reg_err=already');}
        }
      }
     ?>
  </body>
</html>
