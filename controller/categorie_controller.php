<?php

require_once "model/categorie.php";

//RECUPERER lES CATEGORIES
function showAllCategories(){
    $categories=getAllCategories();
    require "view/categories_view.php";
    }

// formumaire pour entrer une nouvelle categorie

function addCategorieForm(){
    if(isset ($_GET['mode'])){
        $mode= $_GET['mode'];
        if ($mode ==='create'){
            //creation nouvelle categorie
            require "view/cat_form_view.php";
        }
        else{
            //mise a jour Categorie
            //mode= update
            //Recuperer la categorie a modifier
            $catId=intval($_GET['id']);
            $cat= getCategorie($catId);
            //ouvrir le form avec la categorie demandée
            require "view/cat_form_view.php";
            
        }
    }
}

//ajoute la nouvelle categorie en BDD

function addCatBdd(){
    if (isset($_POST['catNom'])){
        //CREER UN OBJET CATEGORIE AVEC LES DONNER DE $_POST
        $cat= new Categorie();
        $cat->setNom(htmlspecialchars($_POST['catNom']));
        $cat->setDescription(htmlspecialchars($_POST['catDesc']));
    //Execution de la requete
    $ret=createCategorie($cat);
    //RETOUR SUR LA PAGE DES CATEGORIES
    header('location:http://localhost/projet/index.php?action=showAllCats');

    }
}

function updCatBdd(){
    if (isset($_POST['catNom'])){
        //CREER UN OBJET CATEGORIE AVEC LES DONNER DE $_POST
        $cat= getCategorie($_GET['id']);
        $cat->setNom(htmlspecialchars($_POST['catNom']));
        $cat->setDescription(htmlspecialchars($_POST['catDesc']));
    //Execution de la requete
    $ret=updateCategorie($cat);
    //RETOUR SUR LA PAGE DES CATEGORIES
    header('location:http://localhost/projet/index.php?action=showAllCats');

    }

}

//supprime une categorie 

function delCatBdd(){
    if(isset($_GET['id'])){
    $id=intval(htmlspecialchars($_GET['id']));
    deleteCategorie($id);

    header('location:http://localhost/projet/index.php?action=showAllCats');

    }
}

?>