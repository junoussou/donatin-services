<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="shortcut icon" href="vue/img/icon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="public/style_log.css">
  </head>
  <body>
    <div class="login-form">
      <form action="index.php" method="post">
        <h1 class="title_log">SOKOMATH Service</h1>
        <h2 class="text-center">Connexion</h2>
        <div class="form-group">
          <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" required autocomplete="off">
        </div>
        <div class="form-group">
          <input type="password" name="password" class="form-control" placeholder="Mot de passe" required autocomplete="off">
        </div>
        <div class="form-group">
          <button type="submit" name="bouton" class="btn btn-primary btn-block">Connexion</button>
        </div>
        <p class="text-center">Vous n'avez pas un compte ? <a href="inscrip_log.php">Inscripvez-vous ici</a>.</p>
      </form>
    </div>
  </body>
</html>
