<?php
$title = 'Acceuil';
ob_start();
?>
<h1>Acceuil</h1>
<br><p class="utilisateur"><?=$_SESSION['utilisateur']?></p><br>
<div class="slider">
  <div class="slides">
    <div class="slide"><img src="vue/img/img1.jpg" width="550" height="520" alt="récompenses après tontine"></div>
    <div class="slide"><img src="vue/img/img2.jpg" width="550" height="520" alt="récompenses après tontine"></div>
    <div class="slide"><img src="vue/img/img3.jpg" width="550" height="520" alt="récompenses après tontine"></div>
    <div class="slide"><img src="vue/img/img4.jpg" width="550" height="520" alt="récompenses après tontine"></div>
    <div class="slide"><img src="vue/img/img5.jpg" width="550" height="520" alt="récompenses après tontine"></div>
    <div class="slide"><img src="vue/img/img6.jpg" width="550" height="520" alt="récompenses après tontine"></div>
    <div class="slide"><img src="vue/img/img7.jpg" width="550" height="520" alt="récompenses après tontine"></div>
  </div>
</div>
<?php
$content = ob_get_clean();
require('template.php');
 ?>
