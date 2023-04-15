<?php
$title="Mon bon Boulanger : Details commande";
ob_start();

if(isset($_SESSION['utilisateur'])){
    $statut=$_SESSION['utilisateur']['statut'];
    if($statut==3){

$link="http://localhost/projet/index.php?action=showAllOrder";
}
else{
$link="http://localhost/projet/index.php?action=showUserOrder";
}
}


if(!empty($order)){

?>
<div id="details">
<h1>Détail commande</h1>
<h2><?= $order->getRef_order()?></h2>
<h2><?= $order->getDate()?></h2>
<h2><?= $order->getNom_prenom()?></h2>
</div>
<table class="table">
    <thead>
        <tr class="tete">
        <!-- <th scope="col">#</th> -->
        <th scope="col">produit</th>
        <th scope="col">prix unitaire</th>
        <th scope="col">quantite</th>
        <th scope="col">total</th>
        </tr>
    </thead>
    <tbody>
<?php 
 $somme=0;
foreach($details as $det){
    $somme += $det-> getTotal();
?>
<tr>
<!-- <th scope="row" class="idprod"><?= $det->getId()?></th> -->
<td><?= $det->getNom()?> <?= $det->getDescription()?></td>
<td><?= number_format($det->getPrix(),2, ","," ")?> €</td>
<td><?=$det->getQuantite()?></td>
<td><?= number_format($det->getTotal(),2, ","," ")?> €</td>
<?php
}
?>
</tbody>
<tfoot>
    <tr>
        <td colspan="3" class="tete">Total Commande</td>
        <td class="totalPrix"><?= number_format($somme,2, ","," ") ?> €</td>

    </tr>
</tfoot>
    </table>

<a class="btn btn-primary" href="<?=$link?>"role="button">Retour Commande</a>
<?php
}
else{
?>
<h2 class="vide">Pas de details</h2>

<?php
}
    $content= ob_get_clean();
    require "view/template.php";
?>
