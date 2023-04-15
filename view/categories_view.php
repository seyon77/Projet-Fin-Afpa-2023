<?php

$title="Mon bon Boulanger : les categories";

ob_start();

if(isset($_SESSION['utilisateur'])){
    $statut=$_SESSION['utilisateur']['statut'];
    if($statut !==3){
        header("location:http://localhost/projet/index.php?action=home");
    }

}else{
    header("location:http://localhost/projet/index.php?action=home");
}

    if(!empty($categories)){

    // <!--AFFICHER LES CATEGORIES  --
?>
        <table class="table">
    <thead>
        <tr class="tete">
        <!-- <th scope="col">#</th> -->
        <th scope="col">Nom</th>
        <th scope="col">Description</th>
        <th scope="col">Action</th>

        </tr>
    </thead>
    <tbody>
<?php
    foreach($categories as $cat){
?>
        <tr>
        <!-- <th scope="row" class="idprod"><?= $cat->getId()?></th> -->
        <td><?= $cat->getNom()?></td>
        <td><?= $cat->getDescription()?></td>
        <td>
            <a href="index.php?action=addCatForm&mode=update&id=<?=$cat->getId()?>" class ="btn btn-warning">modifier</a>
            <a href="index.php?action=delCat&id=<?=$cat->getId()?>" class ="btn btn-danger">Supprimer</a></td>

        </tr>
 <?php
    }

?>

    </tbody>
    </table>

<?php
    }
    else{
?>
    <h2 class="vide">Pas de Catégorie</h2>
<?php
    }
?>
<a class="btn btn-success" href="index.php?action=addCatForm&mode=create" role="button">Nouvelle Categorie</a>
<a class="btn btn-primary" href=
"http://localhost/projet/index.php?action=home" role="button">Retour Acceuil</a>

<?php
    $content= ob_get_clean();
    require "view/template.php";
?>


