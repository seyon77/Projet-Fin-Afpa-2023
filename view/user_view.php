<?php
$title="Mon Bon Boulanger : les utilisateurs";
ob_start();

if(isset($_SESSION['utilisateur'])){
    $statut=$_SESSION['utilisateur']['statut'];
    if($statut !==3){
        header("location:http://localhost/projet/index.php?action=home");
    }

}else{
    header("location:http://localhost/projet/index.php?action=home");
}

if(!empty($user)){
    ?>
            <table class="table">
        <thead>
            <tr class="tete">
            <!-- <th scope="col">#</th> -->
            <th scope="col">User</th>
            <th  class="cacher" scope="col">Email</th>
            <th scope="col">Statut</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
    
    <?php
    foreach($user as $us){
    
    ?>
     <tr>
            <!-- <th scope="row"><?= $us->getId()?></th> -->
            <td><?= $us->getFullName()?></td>
            <td class="cacher"><?= $us->getEmail()?></td>
           <td><?= $us->getStatutNom()?></td>
    
    
    
            <td><a href="index.php?action=createUser&mode=update&id=<?=$us->getId()?>" class ="btn btn-warning">modifier</a> 
            <a href="index.php?action=delUser&id=<?=$us->getId()?>" class ="btn btn-danger">Supprimer</a>
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
        <h2 class="vide">Pas d'utilisateur</h2>
    <?php
        }
    ?>
    <a class="btn btn-primary" href=
"http://localhost/projet/index.php?action=home" role="button">Retour Acceuil</a>
    <?php
        $content= ob_get_clean();
        require "view/template.php";
    ?>