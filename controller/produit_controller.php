<?php

require_once "model/produit.php";
require_once "model/categorie.php";

//RECUPERER LES PRODUITS

function showAllProduits(){
    $produits=getAllProds();
    require "view/produits_view.php";
}

function addProduitForm(){
    $categories=getAllCategories();
    if(isset ($_GET['mode'])){
        $mode= $_GET['mode'];
        if ($mode ==='create'){
    require "view/prod_form_view.php";
        }
        else{
            $prodId=intval($_GET['id']);
            $prod=getProduit($prodId);
            require "view/prod_form_view.php";
        }
}
}


function addProdBdd(){
    if (isset($_POST['prodNom'])){
        $prod=new Produit();
        $prod->setNom(htmlspecialchars($_POST['prodNom']));
        $prod->setDescription(htmlspecialchars($_POST['prodDesc']));
        $prod->setCategorie_id(htmlspecialchars($_POST['prodCat']));
        $prod->setPrix(htmlspecialchars($_POST['prodPrix']));
        $prod->setPicture(htmlspecialchars($_POST['prodPict']));

        $ret=createProduit($prod);
        header('location:http://localhost/projet/index.php?action=showAllProd');

    } 
}

function updProdBdd(){
    if (isset($_POST['prodNom'])){
        //CREER UN OBJET PRODUIT AVEC LES DONNER DE $_POST
        $prod= getProduit($_GET['id']);
        $prod->setNom(htmlspecialchars($_POST['prodNom']));
        $prod->setDescription(htmlspecialchars($_POST['prodDesc']));
        $prod->setCategorie_id(htmlspecialchars($_POST['prodCat']));
        $prod->setPrix(htmlspecialchars($_POST['prodPrix']));
        $prod->setPicture(htmlspecialchars($_POST['prodPict']));

        $ret=updateProduit($prod);
        header('location:http://localhost/projet/index.php?action=showAllProd');

    }
}

function delProdbdd(){
    if(isset($_GET['id'])){
        $id=intval(htmlspecialchars($_GET['id']));
        $ret=deleteProduit($id);

        header('location:http://localhost/projet/index.php?action=showAllProd');
    }

}
