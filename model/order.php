<?php

// CLASS ORDER
// --------------------------------------------------

class Order{
    private $id;
    private $client_id;
    private $ref_order;
    private $date;
    private $nom_prenom;
    private $total;

public function getId(){
    return $this->id;
 }
public function getClient_id(){
    return $this->client_id;
}

public function getNom_prenom(){
    return $this->nom_prenom;
}

public function getRef_order(){
    return $this->ref_order;
}
public function getDate(){
    return $this->date;

}
public function getTotal(){
    return $this->total;
}

public function setClient_id($client_id){
    $this->client_id=$client_id;
}

public function setRef_order($ref_order){
    $this->ref_order=$ref_order;
}

}

// FUNCTION QUI RETOURNE TTES LES COMMANDES
// --------------------------------------------------

function getAllOrders(){
    $order=[];
try{
    $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    $sqlReq="SELECT * FROM projet.order";
    $req=$bdd->query($sqlReq);
    $order=$req->fetchAll(PDO::FETCH_CLASS,'Order');
    $req->closeCursor();
}
catch(PDOExeption $ex){
    var_dump($ex->getmessage());
}
finally{
    return $order;
}
}

// FUNCTION QUI RETOURNE UNE COMMANDE
// --------------------------------------------------

function getOrder(int $id){
    $order=false;

    try{
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="SELECT o.id, o.client_id, o.ref_order,CONCAT(u.nom,' ',u.prenom)as nom_prenom,DATE_FORMAT(o.date,'%d/%m/%Y')as date ";
        $sqlReq.=" FROM projet.order as o ";
        $sqlReq.=" INNER JOIN projet.user as u ON u.id=o.client_id WHERE o.id=:id";

        $req=$bdd->prepare($sqlReq);
        $req->bindValue(':id',$id,PDO::PARAM_INT);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS,"Order");
        $order=$req->fetch();
        $req->closeCursor();
    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
    return $order;
    }
}

// FUNCTION QUI CREE UNE COMMANDE 
// --------------------------------------------------

function createOrder(order $order){
    $ret=false;

    try{
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="INSERT INTO projet.order (client_id,ref_order)VALUE(:client_id,:ref_order)";
        $req=$bdd->prepare($sqlReq);
        $req->bindValue(':client_id',$order->getClient_id(),PDO::PARAM_INT);
        $req->bindValue(':ref_order',$order->getRef_order(),PDO::PARAM_STR);
        $ret=$req->execute();
        $ret= intval($bdd->lastInsertId());
    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
        return $ret;
        }
}

// -----------------------------------------------------------
// fonction qui retourne la liste des commande en fonction de id client 
// -----------------------------------------------------------


function getOrderWithTotalandCustomer(?int $ClientId=null){
    $order=[];
    try{
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="SELECT o.id ,o.client_id,CONCAT(u.nom,' ',u.prenom)as nom_prenom,o.ref_order,DATE_FORMAT(o.date,'%d/%m/%Y')as date,";
        $sqlReq .= " ROUND(SUM(p.prix * ol.quantite),2) AS total";
        $sqlReq .=" FROM projet.order as o";
        $sqlReq .=" INNER JOIN order_line AS ol ON ol.order_id=o.id";
        $sqlReq .=" INNER JOIN produit as p ON p.id= ol.prod_id";
        $sqlReq .=" INNER JOIN projet.user as u ON u.id=o.client_id";
        if($ClientId){
            $sqlReq .=" WHERE o.client_id=$ClientId";
        } 
        $sqlReq .=" GROUP BY o.id";
        $req=$bdd->query($sqlReq);
        $req->setFetchMode(PDO::FETCH_CLASS,"Order");
        $order=$req->fetchAll();
        $req->closeCursor();
    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
    return $order;
    }
}