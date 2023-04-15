<?php
$title="Mon Bon Boulanger : Les commandes";
ob_start();

if(isset($_SESSION['utilisateur'])){
    $statut=$_SESSION['utilisateur']['statut'];
    if($statut !==3){
        header("location:http://localhost/projet/index.php?action=home");
}
}else{
    header("location:http://localhost/projet/index.php?action=home");
}
if(!empty($orders)){
?>
    
    <table class="table">
        <thead>
            <tr class="tete">
            <th scope="col">Reference</th>
            <th class="cacher" scope="col">Date</th>
            <th scope="col">Client</th>
            <th class="cacher"scope="col">Montant</th>
            <th scope="col">Action</th>
            </tr>
            </tr>
        </thead>
        <tbody>
    
<?php foreach($orders as $or){
?>
    <tr>           
            <td><?= $or->getRef_order()?></td>
            <td class="cacher"><?= $or->getDate()?></td>
            <td><?= $or->getNom_prenom()?></td>
            <td class="cacher"><?= number_format($or->getTotal(),2)?> €</td>
            <td>
                <a href="index.php?action=showDetailOrder&id=<?=$or->getId()?>" class ="btn btn-warning">infos</a>
            </td>           
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
    <h2 class="vide">Pas de commandes</h2>  
<?php
    }
?>
    <a class="btn btn-primary" href="http://localhost/projet/index.php?action=home" role="button">Retour Acceuil</a>
<?php
$content= ob_get_clean();
require "view/template.php";
?>