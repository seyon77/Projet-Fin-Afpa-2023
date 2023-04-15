<?php
ob_start();
$title="Mon Bon Boulanger: Mes commandes";
if(!empty($orders)){

?>

<table class="table">
    <thead>
        <tr class="tete">
        <th scope="col">Reference</th>
        <th scope="col">Date</th>
        <th scope="col">Client</th>
        <th scope="col">Montant</th>
        <th scope="col">Action</th>
        </tr>
        </tr>
    </thead>
    <tbody>

<?php foreach($orders as $or){
?>
<tr>
        <!-- <th scope="row"><?= $or->getId()?></th> -->
        <td><?= $or->getRef_order()?></td>
        <td><?= $or->getDate()?></td>
        <td><?= $or->getNom_prenom()?></td>
        <td><?= number_format($or->getTotal(),2)?> €</td>
        <td>
            <a href="index.php?action=showUserDetailOrder&id=<?=$or->getId()?>" class ="btn btn-warning">infos</a>
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
<h2>Pas de commandes</h2>
<?php
}
    $content= ob_get_clean();
    require "view/template.php";
?>