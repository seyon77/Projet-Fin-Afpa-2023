<?php

// CLASS ORDER_LINE
// --------------------------------------------------

class Order_line{
    private $id;
    private $order_id;
    private $prod_id;
    private $quantite;
    private $total;
    private $nom;
    private $prix;
    private $description;

public function getId(){
     return $this->id;
}

public function getOrder_id(){
    return $this->order_id;
}

public function getProd_id(){
    return $this->prod_id;
}

public function getQuantite(){
    return $this->quantite;

}
public function getNom(){
    return $this->nom;
}

public function getDescription(){
    return $this->description;
}

public function getPrix(){
    return $this->prix;
}

public function getTotal(){
    return $this->total;
}

public function setOrder_id($order_id){
    $this->order_id=$order_id;
    
}

public function setProd_id($prod_id){
    $this->prod_id=$prod_id;
}
public function setQuantite($quantite){
    $this->quantite=$quantite;
}
    
}

// FUNCTION QUI RETOURNE TTES LES LIGNE DE COMMANDES
// --------------------------------------------------

function getAllOrder_line(){
    $order_line=[];
    try{
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="SELECT * FROM projet.order_line";
        $req=$bdd->query($sqlReq);
        $order_line=$req->fetchAll(PDO::FETCH_CLASS,'Order_line');
        $req->closeCursor();
    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
        return $order_line;
    }
}

// FUNCTION QUI RETOURNE UNE LIGNE DE COMMANDE 
// --------------------------------------------------

function getOrder_line(int $id){
    $order_line=false;

    try{
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="SELECT * FROM projet.order_line WHERE id=:id";
        $req=$bdd->prepare($sqlReq);
        $req->bindValue(':id',$id,PDO::PARAM_INT);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS,"Order_line");
        $order_line=$req->fetch();
        $req->closeCursor();
    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
    return $order_line;
    }
}

// FUNCTION QUI CREE UNE COMMANDE 
// --------------------------------------------------


function createOrder_line(order_line $order_line){
    $ret=false;
    try{
    $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    $sqlReq="INSERT INTO projet.order_line (order_id,prod_id,quantite)VALUE(:order_id,:prod_id,:quantite)";
    $req=$bdd->prepare($sqlReq);
    $req->bindValue(':order_id',$order_line->getOrder_id(),PDO::PARAM_INT);
    $req->bindValue(':prod_id',$order_line->getProd_id(),PDO::PARAM_INT);
    $req->bindValue(':quantite',$order_line->getQuantite(),PDO::PARAM_INT);
    $ret=$req->execute();
}
catch(PDOExeption $ex){
    var_dump($ex->getmessage());
}
finally{
    return $ret;
    }
}

// -----------------------------------------------------------

function getOrderlineByOrder(int $orderId){
    $orderline=[];
    try{
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="SELECT ol.id,ol.order_id,ol.prod_id,p.nom,p.prix,p.description,ol.quantite,ROUND(SUM(p.prix * ol.quantite),2)AS total FROM projet.order_line as ol ";
        $sqlReq .=" INNER JOIN produit as p ON p.id= ol.prod_id ";
        $sqlReq .=" WHERE ol.order_id= $orderId";
        $sqlReq .=" GROUP BY ol.id";
        $req=$bdd->query($sqlReq);
        $req->setFetchMode(PDO::FETCH_CLASS,"Order_line");
        $orderline=$req->fetchAll();
        $req->closeCursor();
    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
    return $orderline;
    }
}
