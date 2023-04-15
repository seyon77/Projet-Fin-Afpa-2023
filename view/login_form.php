<?php
$title="Mon Bon Boulanger : connexion";
if(isset($_SESSION['notFound'])){
  $display="";
}
else{
  $display="display:none";
}

ob_start();
?>

<div class=container>
<form action="index.php?action=connexionUser" method="POST">
  <div class="mb-3">
    <label for="emailSign" class="form-label">Email</label>
    <input type="email" class="form-control" id="emailSign" name ="emailSign" value="" required>
  </div>
  <div class="mb-3">
    <label for="passwdSign" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" id="passwdSign"  name="passwdSign" value=""required>
  </div>
  <button type="submit" class="btn btn-primary">connexion</button>
  <a href="index.php?action=createUser&mode=create" class ="btn btn-success">S'inscrire</a>
  <p style=<?=$display?>>Email ou Mot de passe incorrect <p>
 <?php
  unset($_SESSION['notFound']);
 ?>
  
</form>
</div>
<?php
    $content= ob_get_clean();
    require "view/template.php";
?>