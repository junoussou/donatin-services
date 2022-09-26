<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?=$title ?></title>
    <meta http-equiv="cache-control" content="no-cache"/>
    <meta name="description" content="Société de Adogbè situé à Danto, à côté de la morgue. La créatrice de cette structure est Mme Marie-Thérèse KOKOSSOU Epse SODJINOU."/>
    <meta name="keywords" content="Marie-Thérèse, KOKOSSOU, SODJINOU, SOKOMATH, Danto, Michel"/>
    <meta name="author" content="Charles Auguste Junior OUSSOU"/>
    <meta name="Copyright" content="Marie-Thérèse KOKOSSOU"/>
    <link rel="shortcut icon" href="vue/img/icon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="public/style_menu.css">
    <link rel="stylesheet" href="public/style_log.css">
    <link rel="stylesheet" href="public/ui.css">
    <script type="text/javascript" src="public/all.min.js"></script>
  </head>
  <body>
    <input type="checkbox" id="check">
    <label for="check">
      <i class="fas fa-bars" id="btn"></i>
      <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
      <header>
        <a href="index.php?controller=control_home">SOKOMATH Services</a>
      </header>
      <ul>
        <li><a href="index.php?controller=control_home"><i class="fas fa-home"></i>Acceuil</a></li>
        <li><a href="index.php?controller=control_inscription"><i class="fas fa-user-plus"></i>Inscription</a></li>
        <li><a href="index.php?controller=control_consultation"><i class="fas fa-book"></i>Consultation</a></li>
        <li><a href="index.php?controller=control_consultPatAgent"><i class="fas fa-book-open"></i>liste par agent</a></li>
        <?php if ($_SESSION['pseudo'] == 'admin' OR $_SESSION['pseudo'] == 'kokossoumt' OR $_SESSION['pseudo'] == 'samfo16'): ?>
          <li><a href="index.php?controller=control_parameter"><i class="far fa-setting"></i>paramètres</a></li>
          <li><a href="index.php?controller=control_history"><i class="fas fa-calendar-week"></i>Historique</a></li>
        <?php endif; ?>
        <li><a href="index.php?controller=control_logout"><i class="fas fa-power-off"></i>Déconnexion</a></li>
      </ul>
    </div><br><br><br>
    <section>
      <?=$content ?>
    </section>
  </body>
</html>
