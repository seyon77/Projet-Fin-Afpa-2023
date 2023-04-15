<?php
$title="Mon Bon Boulanger : Mon panier";
ob_start();

if(isset($_SESSION['utilisateur'])){
    $link="http://localhost/projet/index.php?action=cart2order";
}else{
    $link="http://localhost/projet/index.php?action=loginUser";
}

if(!empty($_SESSION['panier'])){

    ?>
    <table class="table">
        <thead>
            <tr class="tete">
            <th scope="col">Produit</th>
            <th scope="col">Quantite</th>
            <th class="cacher"class=scope="col">Prix Unitaire</th>
            <th scope="col">Action</th>
            <th scope="col">Total</th>      

            </tr>
        </thead>
        <tbody>
    <?php
    $somme=0;// total prix du panier ;
    $selection=$_SESSION['panier'];
    foreach($selection as $id=>$quantite){//on parcour $session;
        $infosProduit=getProduit($id);
        $somme += ($infosProduit->getPrix())*$quantite;
    ?>
    <tr>
    <th scope="row" class="idprod"><?= $infosProduit->getNom()?> <?= $infosProduit->getDescription()?></th>
    <td><a href="index.php?action=delProdCart&id=<?=$infosProduit->getId() ?>" class ="btn btn-danger me-2">-</a><?=$quantite?><a href="index.php?action=addProdPanier&id=<?=$infosProduit->getId() ?>" class ="btn btn-success ms-2">+</a></td>
    <td class="cacher"><?= number_format($infosProduit->getPrix(),2, ","," ")?> €</td>
    <td>
        <a href="index.php?action=delProdPanier&id=<?=$infosProduit->getId() ?>" class ="btn btn-danger">Supprimer</a>       
    </td>
    <td><?= number_format(($infosProduit->getPrix()*$quantite),2, ","," ")?> €</td>
    <?php
    }
    ?>
    </tbody>
    <tfoot>
        <tr>
            <td class="cacher" colspan="4" class="tete">Total Commande</td>
            <td class="totalPrix"><?= number_format($somme,2, ","," ") ?> €</td>
    
        </tr>
    </tfoot>
        </table>
        <a href="index.php?action=delCart" class ="btn btn-danger">Vider le panier</a>
        <a href="<?=$link?>" class ="btn btn-success">Commander</a>
        <?php
    }
    else{
    ?>
    <h2 class="vide">Pas de Panier</h2>
    <a href="http://localhost/projet/index.php?action=showAllProd" class ="btn btn-primary">Retour produit</a>
    
    
    <?php
    }
    $content= ob_get_clean();
    require "view/template.php";
    ?>