<?php


// CLASS PRODUIT
// --------------------------------------------------

class Produit{
    private $id;
    private $nom;
    private $description;
    private $categorie_id;
    private $prix;
    private $categorie;
    private $picture;

public function getId(){
    return $this->id;
}
public function getNom(){
    return $this->nom;
}
public function getDescription(){
    return $this->description;
}
public function getCategorie_id(){
    return $this->categorie_id;
}
public function getPrix(){
    return $this->prix;
}
public function getCategorie(){
    return $this->categorie;
}

public function getPicture(){
    return $this->picture;
}

public function setNom($nom){
    $this->nom = $nom;
}

public function setDescription($description){
    $this->description = $description;
}

public function setCategorie_id($categorie_id){
    $this->categorie_id = $categorie_id;
}

public function setPicture($picture){
    $this->picture =$picture;
}

public function setPrix($prix){
    $this->prix = $prix;
}

}

// FUNCTION QUI RETOURNE TOUS LES PRODUIT AVEC NOM DE LA CATEGORIE
//----------------------------------------------------------------
function getAllProds(){
    $produit=[];
    try{ 
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="SELECT produit.id,produit.nom,produit.description,categorie_id,produit.prix,produit.picture,categorie.nom as categorie FROM produit";
        $sqlReq.=" INNER JOIN categorie ON produit.categorie_id=categorie.id";
        $req=$bdd->query($sqlReq); 
        $produit=$req->fetchAll(PDO::FETCH_CLASS,'Produit');
        $req->closeCursor();

    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
    return $produit;
    }

}

// FUNCTION QUI RETOURNE UN PRODUIT
// --------------------------------------------------

function getProduit(int $id){
    $produit=false;
    try{
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="SELECT * FROM produit WHERE id=:id";
        $req=$bdd->prepare($sqlReq);
        $req->bindValue(':id',$id,PDO::PARAM_INT);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS,"Produit");
        $produit=$req->fetch();
        $req->closeCursor();
    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
    return $produit;
    }
}

// FUNCTION QUI CREE UN PRODUIT
// --------------------------------------------------

function createProduit(produit $produit){
    $ret=false;

    try{
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="INSERT INTO produit (nom,description,categorie_id,prix,picture)VALUE(:nom,:description,:categorie_id,:prix,:picture)";
        $req=$bdd->prepare($sqlReq);
        $req->bindValue(':nom',$produit->getNom(),PDO::PARAM_STR);
        $req->bindValue(':description',$produit->getDescription(),PDO::PARAM_STR);
        $req->bindValue(':categorie_id',$produit->getCategorie_id(),PDO::PARAM_INT);
        $req->bindValue(':prix',$produit->getPrix(),PDO::PARAM_STR);
        $req->bindValue(':picture',$produit->getPicture(),PDO::PARAM_STR);

        $ret=$req->execute();
    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
        return $ret;
        }

}

// FUNCTION QUI MET A JOUR UN PRODUIT 
// --------------------------------------------------

function updateProduit(produit $produit){
    $updateProduit=false;
    try{
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="UPDATE produit SET nom=:nom,description=:description,categorie_id=:categorie_id,prix=:prix,picture=:picture WHERE id=:id";
        $req=$bdd->prepare($sqlReq);
        $req->bindValue(':id',$produit->getId(),PDO::PARAM_INT);
        $req->bindValue(':nom',$produit->getNom(),PDO::PARAM_STR);
        $req->bindValue(':description',$produit->getDescription(),PDO::PARAM_STR);
        $req->bindValue(':categorie_id',$produit->getCategorie_id(),PDO::PARAM_INT);
        $req->bindValue(':prix',$produit->getPrix(),PDO::PARAM_STR);
        $req->bindValue(':picture',$produit->getPicture(),PDO::PARAM_STR);
        $updateProduit=$req->execute();
    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
        return $updateProduit;
        }
}

// FUNCTION QUI SUPPRIME UN PRODUIT
// --------------------------------------------------

function deleteProduit(int $id){
    $deleteProduit=false;

    try{
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="DELETE FROM produit WHERE id=:id";
        $req=$bdd->prepare($sqlReq);
        $req->bindValue(':id',$id,PDO::PARAM_INT);
        $deleteProduit=$req->execute();
    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
        return $deleteProduit;
        }

}

