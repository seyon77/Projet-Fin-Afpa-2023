<?php
ob_start();

switch($mode){
  case 'create':
      $title="Mon Bon Boulanger: Creation Compte";
      $link="index.php?action=addUserBdd";
      $userNom="";
      $userPrenom="";
      $userEmail="";
      $userPasswd="";
      $display="display:none";
      $submit="Ajouter l'utilisateur";
      break;
  case'update':
    $title="Mon Bon Boulanger: Modification Compte";
    $link="index.php?action=updUserBdd&id={$user->getId()}";
      $userNom=$user->getNom();
      $userPrenom=$user->getPrenom();
      $userEmail=$user->getEmail();
      $userPasswd=$user->getpassword();
      $userStatut=$user->getStatut(); 
      $display="";
      $submit="modifier l'utilisateur";

  
}

?>
<div class=container>
<form action="<?= $link ?>" method="POST">
  <div class="mb-3">
    <label for="nomUser" class="form-label">Nom</label>
    <input type="text" class="form-control" id="nomCreate" name ="nomUser" value="<?= $userNom ?>" required>
  </div>
  <div class="mb-3">
    <label for="prenomUser" class="form-label">Prenom</label>
    <input type="text" class="form-control" id="prenomCreate" name ="prenomUser" value="<?= $userPrenom ?>" required>
  </div>
  <div class="mb-3">
    <label for="emailUser" class="form-label">Email</label>
    <input type="email" class="form-control" id="emailCreate" name ="emailUser" value="<?= $userEmail ?>" required>
  </div>
  <div class="mb-3">
    <label for="passwdUser" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" id="passwdCreate"  name="passwdUser" value="<?= $userPasswd ?>"required>
  </div>
  <?php
if(isset($_SESSION['utilisateur'])){
  $userStatut=$_SESSION['utilisateur']['statut'];

if($mode=="update" AND $userStatut==3){
?>
  <div class="mb-3">
<label for="statut">statut:</label>
<br>
<select  name="statutUser" id="statut"value="" required>
<option value="">--STATUT--</option>
<?php
foreach($statut as $stat){
  $selected="";
  If($mode=="update" AND $stat->getId() == $user->getStatut()){
    $selected = "selected";
}
?>
<option value="<?= $stat->getId()?>"<?= $selected?>><?= $stat->getNom()?></option>
<?php
}
?>
</select>
  </div>
  <?php
  }
}
?>

  <button type="submit" class="btn btn-primary"><?= $submit ?></button>
  </form>
</div>

<?php
    $content= ob_get_clean();
    require "view/template.php";
?>