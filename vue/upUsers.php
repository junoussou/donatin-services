<?php
  $title = 'Modifier';
  ob_start();
 ?>
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
   <form action="index.php" method="post">
     <h1 class="title_log">SOKOMATH Service</h1>
     <h2 class="text-center">Formulaire de modification agent</h2>
     <input type="hidden" name="identite" value="<?=$_GET['id'] ?>">
     <div class="form-group">
       <input type="text" value="<?=$_GET['nomPrenoms'] ?>" name="nom" class="form-control" placeholder="Nom et Prénoms" required autocomplete="off">
     </div>
     <div class="form-group">
       <input type="mail" value="<?=$_GET['mail'] ?>" name="email" class="form-control" placeholder="Adresse E-mail" required autocomplete="off">
     </div>
     <div class="form-group">
       <input type="phone" value="<?=$_GET['phone'] ?>" name="contact" class="form-control" placeholder="Numéro de téléphone" required autocomplete="off" maxlength="8">
     </div>
     <div class="form-group">
       <input type="text" value="<?=$_GET['pseudo'] ?>" name="pseudo" class="form-control" placeholder="Pseudo" required autocomplete="off">
     </div>
     <div class="form-group">
       <input type="password" name="password" class="form-control" placeholder="Mot de passe" required autocomplete="off">
     </div>
     <div class="form-group">
       <input type="hidden" name="controller" value="control_updateUsers">
       <button type="submit" name="bouton" class="btn btn-primary btn-block">Modifer</button>
     </div>
   </form>
 </div>
<?php
  $content = ob_get_clean();
  require('template.php');
 ?>
