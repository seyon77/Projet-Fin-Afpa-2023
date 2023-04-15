<?php
if(isset($_SESSION['panier'])){
  $qtePanier=array_sum(array_values(($_SESSION['panier'])));
}
else{
  $qtePanier=0;
}
if(isset($_SESSION['utilisateur'])){
  $fullName=$_SESSION['utilisateur']['fullName'];
  $bienvenue="Bienvenue";
  $connexion="Deconnexion";
  $link="http://localhost/projet/index.php?action=delUserSession";
  $statut=$_SESSION['utilisateur']['statut'];
  if($statut==3){
    $display="";
  }else{
    $display="display:none";
  }
}

else{
  $fullName="";
  $connexion="Connexion";
  $bienvenue="";
  $display="display:none";
  // $qtePanier=0;
  $link="http://localhost/projet/index.php?action=loginUser";
}

?>

<header>
  <div class="logoEpi">
<img  class="invers" src="logo/—Pngtree—roti bread bakery_7420167.png" alt="logo"height="180px" width="180px">
<div class="container p-1 adress">
        <h1 class="text-center titre">Mon Bon Boulanger</h1>
        <h6 class="text-center">20 rue de Paris</h6>
        <h6 class="text-center">75028</h6>
        <h6 class="text-center">Paris</h6>
        <h6 class="text-center">✆ : 09.87.99.99.99</h6>
</div>
<img class ="invers2"src="logo/—Pngtree—roti bread bakery_7420167.png" alt="logo"height="180px" width="180px">
</div>


<nav class=" navbar navbar-expand-lg bg-body-tertiary ">
  <div class="container-fluid">
        <a class="navbar-brand" href="http://localhost/projet/index.php?action=home">Acceuil</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li style="<?=$display?>" class="nav-item">
          <a class="nav-link" href="http://localhost/projet/index.php?action=showAllCats">Les Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/projet/index.php?action=showAllProd">Les Produits</a>
        </li>
        <li style="<?=$display?>" class="nav-item">
          <a class="nav-link" href="http://localhost/projet/index.php?action=showAllOrder">Les Commandes</a>
        </li>
        <li style="<?=$display?>" class="nav-item">
          <a class="nav-link" href="http://localhost/projet/index.php?action=ShowAllUser">Les Utilisateurs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/projet/index.php?action=showCart"">Panier <span class="badge text-success"><?=$qtePanier?></span></a>

          <li class="navbar-text ms-5 me-5 bienvenue"><?=$bienvenue?> <?=$fullName?></li>

<?php
    if(isset($_SESSION['utilisateur'])){
       $Userid=$_SESSION['utilisateur']['id'];
        if($statut==1 || $statut==2){
?>
        <li class="nav-item">
          <a class="nav-link" href="index.php?action=createUser&mode=update&id=<?=$Userid?>">Modifier Compte</a>
        </li>
        <?php
}
if($statut==2){
?>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/projet/index.php?action=showUserOrder">Mes Commandes</a>
        </li>
<?php
}
}
?> 

    <li class="nav-item">
  <a class="nav-link connect" href="<?=$link?>"><?=$connexion?></a>
  </li>

      </ul>
    </div>
  </div>
</nav>
</header>