<?php

function showCart(){
    require "view/cart_view.php";

}

function createCart(){
    if(!isset($_SESSION['panier'])){
        $_SESSION['panier']=[];
    } 
}


function addProdCart(int $id){
    createCart();
    $prod_id=intval($_GET['id']);
    

    if (isset($_SESSION['panier'][$prod_id])){
        $_SESSION['panier'][$prod_id]++;   
    }
    else{
        $_SESSION['panier'][$prod_id]=1;
    }
    header("location:http://localhost/projet/index.php?action=showAllProd");

}

function delProdCart(int $id){

    $prod_id=intval($_GET['id']);

    if (($_SESSION['panier'][$prod_id])==1){
        unset($_SESSION['panier'][$prod_id]);
    }
    else{
        $_SESSION['panier'][$prod_id]--;
    }
    header("location:http://localhost/projet/index.php?action=showCart");

}

function addProdPanier(int $id){
    $prod_id=intval($_GET['id']);

    if (isset($_SESSION['panier'][$prod_id])){
        $_SESSION['panier'][$prod_id]++;  
    }
    header("location:http://localhost/projet/index.php?action=showCart");
    

}

function delCart(){
    if ($_SESSION['panier']){
        unset($_SESSION['panier']);
    }
    header("location:http://localhost/projet/index.php?action=showCart");

}

function delProdPanier(){
    $prod_id=intval($_GET['id']);
    if ($_SESSION['panier']){
        unset($_SESSION['panier'][$prod_id]);
    }
    header("location:http://localhost/projet/index.php?action=showCart");
    
}

function cart2Order(){
    if(isset($_SESSION['utilisateur'])){
        $curDate=new DateTime();
        $num=$curDate->format('Ymd-h:i');
        $refCde="REF_".$num;
        $order=new Order();
        $order->setClient_id($_SESSION['utilisateur']['id']);
        $order->setRef_order($refCde);
        $ret=createOrder($order);
        $cart=$_SESSION['panier'];
        foreach($cart as $prod_id=>$quantite){
         $order_line= new Order_line();
         $order_line->setProd_id($prod_id);
         $order_line->setOrder_id($ret);
         $order_line->setQuantite($quantite);
         $createOrder=createOrder_line($order_line);

        }
        $clientId=$_SESSION['utilisateur']['id'];
        change2client($clientId);
        delCart();
       
    }
        header('location:http://localhost/projet/index.php?action=showUserOrder');
    }

?>