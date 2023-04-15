<?php
$title="Mon Bon Boulanger : les produits";
ob_start();

if(isset($_SESSION['utilisateur'])){
    $statut=$_SESSION['utilisateur']['statut'];
    if($statut==3){
        $display="";
      }
      else{
        $display="display:none";
      }
}
else{
    $display="display:none";
}

if(!empty($produits)){
?>
<div class="grosbloc">
<?php
    foreach($produits as $prod){
?>
    <div class='prod'>
    <h3 class='article'><?=$prod->getNom()?></h3>
    <h5 class='article'><?= $prod->getDescription()?></h5>
    <h4><?="Prix:  ".number_format($prod->getPrix(),2, ","," ")."€" ?></h4>
    <div>
    <img  class='imageprod'src="<?=$prod->getPicture()?>" alt="image produit" height="80px" width="80px">
    </div>

    <a class="btn btn-success btnprod" href="index.php?action=addProdCart&id=<?=$prod->getId()?>">Ajouter au panier</a>
    <a style="<?=$display?>" class="btn btn-warning btnprod" href="index.php?action=addProdForm&mode=update&id=<?=$prod->getId()?>">Modifier</a>  
    <a style="<?=$display?>" class="btn btn-danger btnprod" href="index.php?action=delProd&id=<?=$prod->getId()?>">Supprimer</a>
    </div>

<?php
    }
    }
    else{
        ?>       
        <h2 class="vide">Pas de produits</h2>
        <?php
    }      
?>
</div>
<a  style="<?=$display?>" class="btn btn-success" href="index.php?action=addProdForm&mode=create" role="button">Nouveau Produit</a>
<a class="btn btn-primary" href=
"http://localhost/projet/index.php?action=home" role="button">Retour Acceuil</a>

<?php
    $content= ob_get_clean();
    require "view/template.php";
?>
