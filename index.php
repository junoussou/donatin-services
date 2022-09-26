<?php
  session_start();
  require_once('controller.php');
  if (!isset($_SESSION['utilisateur'])) {
    $_SESSION['login_time'] = 0;
    control_login();
  }else{
    if ((time() - $_SESSION['login_time']) >= 36000) {//si le temps de connexion dépasse 10 heures (36000 secondes)
      session_destroy();
      control_login();
      die();
    }else {
      if (isset($_GET['controller'])) {
        $_GET['controller']();
      }else{
        if (isset($_POST['controller'])) {
          $_POST['controller']();
        }else{
          control_inscription();
        }
      }
    }
  }

 ?>
