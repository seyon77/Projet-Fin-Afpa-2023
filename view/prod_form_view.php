<?php
$title="Mon Bon Boulanger : Nouveau Produit";

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
        $link="index.php?action=addProdBdd";
        $prodNom="";
        $prodDesc="";
        $prodPrix="";
        $prodPict="";
        $submit="Ajouter le produit";
        
        break;
    case'update':
        $link="index.php?action=updProdBdd&id={$prod->getId()}";
        $prodNom=$prod->getNom();
        $prodDesc=$prod->getDescription();
        $prodPrix=$prod->getPrix();
        $prodPict=$prod->getPicture();
        $submit="Enregistrer les modifications";
        break;
}
?>

<div class=container>
<form action="<?= $link ?>" method="POST">
    <div class="mb-3">
    <label for="prodNom" class="form-label">Nom</label>
    <input type="text" class="form-control" id="prodNom" name ="prodNom" value="<?= $prodNom ?>"required>
</div>

<div class="mb-3">
    <label for="prodDesc" class="form-label">Description</label>
    <input type="textarea" class="form-control" id="prodDesc" rows="3" cols="50" name="prodDesc" value="<?= $prodDesc?>"required>
</div>

<div class="mb-3">
    <label for="prodCat" class="form-label">Categories:</label>
    <br>
        <select name="prodCat" id="prodCat"value=""required>
        <option value="">--Categories--</option>
<?php
        foreach($categories as $cat){
        $selected = "";
        If($mode=="update" AND $cat->getId() == $prod->getCategorie_id()){
            $selected = "selected";
        }
?>
<option value="<?= $cat->getId()?>" <?= $selected?> ><?= $cat->getNom()?></option>

<?php
}
?>

        </select>
</div>
<div class="mb-3">
    <label for="prodPrix" class="form-label">Prix</label>
    <input type="textarea" class="form-control" id="prodPrix"name="prodPrix" value ="<?= $prodPrix ?>"required>
  </div>

  <div class="mb-3">
    <label for="prodPict" class="form-label">Image</label>
    <input type="textarea" class="form-control" id="prodPict" rows="3" cols="50" name="prodPict" value ="<?= $prodPict ?>">
  </div>



  <button type="submit" class="btn btn-primary"><?= $submit ?></button>
</form>
</div>

<?php
    $content= ob_get_clean();
    require "view/template.php";
?>


