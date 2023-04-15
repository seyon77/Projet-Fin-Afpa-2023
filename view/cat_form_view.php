<?php
$title="Mon bon Boulanger : Nouvelle Categorie";

ob_start();

if(isset($_SESSION['utilisateur'])){
  $statut=$_SESSION['utilisateur']['statut'];
  if($statut !==3){
      header("location:http://localhost/projet/index.php?action=home");
  }

}else{
  header("location:http://localhost/projet/index.php?action=home");
}


switch($mode){
    case 'create':
        $link="index.php?action=addCatBdd";
        $catNom="";
        $catDesc="";
        $submit="Ajouter la catégorie";
        
        break;
    case'update':
        $link="index.php?action=updCatBdd&id={$cat->getId()}";
        $catNom=$cat->getNom();
        $catDesc=$cat->getDescription();
        $submit="Enregistrer les modifications";
        break;
}

?>

<div class=container>
<form action="<?= $link ?>" method="POST">
  <div class="mb-3">
    <label for="catNom" class="form-label">Nom</label>
    <input type="text" class="form-control" id="catNom" name ="catNom" value="<?= $catNom ?>" required>
  </div>

  <div class="mb-3">
    <label for="catDesc" class="form-label">Description</label>
    <input type="textarea" class="form-control" id="catDesc" rows="3" cols="50" name="catDesc" value="<?= $catDesc ?>"required>
  </div>

  <button type="submit" class="btn btn-primary"><?= $submit ?></button>
</form>
</div>

<?php
    $content= ob_get_clean();
    require "view/template.php";
?>