<?php

// CLASS CATEGORIE 
// --------------------------------------------------
class Categorie{
    private int $id;
    private string $nom;
    private string $description;

    public function getId():int{
        return $this->id;
    }

    public function getNom():string{
        return $this->nom;
    }

    public function getDescription():string{
        return $this->description;
    }
    
    public function setNom($nom) {
        $this->nom = $nom;
    }
    public function setDescription($description){
        $this->description=$description;

    }
}

// FUNCTION QUI RETOURNE TTES LES CATEGORIES
// --------------------------------------------------

function getAllCategories(){
    $categorie=[];
    try{ 
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="SELECT * FROM categorie";
        $req=$bdd->query($sqlReq); 
        $categorie=$req->fetchAll(PDO::FETCH_CLASS,'Categorie');
        $req->closeCursor();
    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
    return $categorie;
    }
}

// FUNCTION QUI RETOURNE UNE CATEGORIE
// --------------------------------------------------

function getCategorie(int $id){
    $categorie=false;
    try{
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="SELECT * FROM categorie WHERE id=:id";
        $req=$bdd->prepare($sqlReq);
        $req->bindValue(':id',$id,PDO::PARAM_INT);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS,"Categorie");
        $categorie=$req->fetch();
        $req->closeCursor();
    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
    return $categorie;
    }
}

// FUNCTION QUI CREE UNE CATEGORIE
// --------------------------------------------------

function createCategorie(Categorie $categorie){
    $ret=false;
    try{
    $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    $sqlReq="INSERT INTO categorie(nom,description)VALUE(:nom,:description)";
    $req=$bdd->prepare($sqlReq);
    $req->bindValue(':nom',$categorie->getNom(),PDO::PARAM_STR);
    $req->bindValue(':description',$categorie->getDescription(),PDO::PARAM_STR);
    $ret=$req->execute();
    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
        return $ret;
    }
}

// FUNCTION QUI SUPPRIME UNE CATEGORIE
// --------------------------------------------------

function deleteCategorie(int $id){
    $deleteCategorie=false;
    try{
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="DELETE FROM categorie WHERE id=:id";
        $req=$bdd->prepare($sqlReq);
        $req->bindValue(':id',$id,PDO::PARAM_INT);
        $deleteCategorie=$req->execute();
    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
        return $deleteCategorie;
        }

}

// FUNCTION QUI MET A JOUR UNE CATEGORIE 
// --------------------------------------------------

function updateCategorie(Categorie $categorie){
    $updateCategorie=false;
    try{
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="UPDATE categorie SET nom=:nom,description=:description WHERE id=:id";
        $req=$bdd->prepare($sqlReq);
        $req->bindValue(':id',$categorie->getId(),PDO::PARAM_INT);
        $req->bindValue(':nom',$categorie->getNom(),PDO::PARAM_STR);
        $req->bindValue(':description',$categorie->getDescription(),PDO::PARAM_STR);
        $updateCategorie=$req->execute();
    }   
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
        return $updateCategorie;
        }

}

?>