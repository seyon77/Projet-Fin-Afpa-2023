<?php

session_start();
require "controller/categorie_controller.php";
require "controller/produit_controller.php";
require "controller/order_controller.php";
require "controller/cart_controller.php";
require "controller/security_controller.php";

function home(){
    $title="Mon Bon Boulanger";
    ob_start();
?>
    <div class="container p-1">
        <!-- <div class="text-bienvenue">
        <h7>Bienvenue dans notre boulangerie, où le parfum envoûtant du pain frais et des pâtisseries délicieuses vous accueille dès que vous franchissez la porte. Nous sommes fiers de vous offrir une expérience de boulangerie traditionnelle, où chaque produit est préparé avec soin et passion pour vous offrir le meilleur goût possible. Notre équipe de boulangers talentueux utilise des ingrédients de qualité supérieure pour créer des pains, des viennoiseries et des pâtisseries qui raviront vos papilles. Que vous cherchiez un petit-déjeuner rapide, une collation ou un dessert pour une occasion spéciale, notre boulangerie est l'endroit idéal pour satisfaire vos envies sucrées. Nous sommes impatients de vous accueillir et de vous faire découvrir notre sélection de produits artisanaux et délicieux.</h7>
        </div> -->
        <img class="d-block mx-auto imageAcceuil" src="https://i.postimg.cc/8zq4kfzF/bread-g396b22200-1920.jpg" alt="image de la boulangerie">
        
    </div>
<?php

$content = ob_get_clean();
require "view/template.php";
}

//routeur

if(isset($_GET['action'])){
    $action=htmlspecialchars(($_GET['action']));
    switch($action){
        case 'home':
            home();
            break;
        case 'showAllCats':
            showAllCategories();
            break;
        case 'addCatForm':
             //nouvelle categorie (formulaire de saisie)
             addCategorieForm();
            break;
            //ajoute la categorie a la BDD
            //origine =catForm
        case 'addCatBdd':
                addCatBdd();
                break;
             //mettre a jour une categorie 
        case 'updCatBdd':
            updcatBdd();
            break;
            //SUPPRIME UNE CATEGORIE DE LA BDD
        case 'delCat':
            delCatBdd();
            break;

        //// ACTION PRODUIT
        case 'showAllProd':
        showAllProduits();
            break;
        case'addProdForm':
            addProduitForm();
            break;
        case'addProdBdd':
            addProdBdd();
            break;
        case 'updProdBdd':
            updProdBdd();
            break;
        case 'delProd':
            delProdBdd();
            break;
        case 'showAllOrder':
            showAllOrders();
            break;
        case'showUserOrder':
            showUserOrder();
            break;
        case'showUserDetailOrder':
            showUserDetailOrder();
            break;
        case 'showDetailOrder':
            showDetailOrder();
            break;
        case 'showCart':
            showCart();
            break;
        case 'addProdCart':
                if(isset($_GET['id'])){
                    addProdCart($_GET['id']);
                }
                else{
                    header("location:http://localhost/projet/index.php?action=showAllProd");
                }
                break;
        case'delProdCart':
                if(isset($_GET['id'])){
                    delProdCart($_GET['id']);
                }
                else{
                    header("location:http://localhost/projet/index.php?action=showCart");
                }
                break;
        case 'addProdPanier':
                if(isset($_GET['id'])){
                     addProdPanier($_GET['id']);
                }
                else{
                     header("location:http://localhost/projet/index.php?action=showCart");
                }
                break;
        case "delCart":
                delCart();
                break;
        case 'delProdPanier':
                if(isset($_GET['id'])){
                    delProdPanier($_GET['id']);
                }
                else{
                    header("location:http://localhost/projet/index.php?action=showCart");
                }
                break;
        case'loginUser':
                loginUser();
                break;
        case 'createUser':
                addUserForm();
                break;
        case'connexionUser':
                traitementConnexion();
                break;
        case 'ShowAllUser':
                showAllUserStatut();
                break;
        case'addUserBdd':
                addUserBdd();
                break;
        case 'updUserBdd':
                updUserBdd();
                break;
        case'delUser':
                delUserBdd();
                break;
        case 'delUserSession':
                delUserSession();
                break;
        case'cart2order':
                cart2order();
                break;
       
            default:
            header("location:index.php?action=home");
    }
}
else{
    header("location:index.php?action=home");
        //si pas d'action on n'affiche tous
        ;   
    }