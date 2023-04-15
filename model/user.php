<?php

//CLASS USER

class User{
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $password;
    private $statut;
    private $fullName;
    private $statut_nom;

    public function getId(){
        return $this->id;
    }
    public function getNom(){
        return $this->nom;
    }
    public function getPrenom(){
        return $this->prenom;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getStatut(){
        return $this->statut;
    }
    public function getFullName(){
        return ($this->nom." ".$this->prenom);
    }
    public function getStatutNom(){
        return $this->statut_nom;
    }
    public function setNom($nom){
        $this->nom =$nom;
    }
    public function setPrenom($prenom){
        $this->prenom =$prenom;
    }
    public function setEmail($email){
        $this->email =$email;
    }
    public function setPassword($password){
        $this->password=$password;
    }
    public function setStatut($statut){
        $this->statut=$statut;
    }
    

}

//class STATUT

class Statut{
    private $id;
    private $nom;

    public function getId(){
        return $this->id;
    }
    public function getNom(){
        return $this->nom;
    }
    public function setNom($nom){
        $this->nom = $nom;
    }
}

//----------------------------------------------------------//

function getAllStatuts(){
    $statut=[];
    try{ 
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="SELECT * FROM statut";
        $req=$bdd->query($sqlReq); 
        $statut=$req->fetchAll(PDO::FETCH_CLASS,'Statut');
        $req->closeCursor();
    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
    return $statut;
    }
    
}

//----------------------------------------------------------//

function getAllUserStatut(){
    $user=[];
    try{ 
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="SELECT u.id,u.nom,u.prenom,u.email,u.password,u.statut,s.nom AS statut_nom";
        $sqlReq.=" FROM projet.user AS u";
        $sqlReq.=" INNER JOIN projet.statut as s on s.id=u.statut";
        $req=$bdd->query($sqlReq); 
        $user=$req->fetchAll(PDO::FETCH_CLASS,'user');
        $req->closeCursor();
    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
        return $user;
    }

}

//----------------------------------------------------------//

function getStatutName(int $id){
    $statutName=false;
    try{ 
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="SELECT statut.nom FROM statut WHERE id=:id";
        $req=$bdd->prepare($sqlReq);
        $req->bindValue(':id',$id,PDO::PARAM_INT);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS,"Statut");
        $statutName=$req->fetch();
        $req->closeCursor();
    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
    return $statutName;
    }
}

//----------------------------------------------------------//

//fonction qui retourne tous les utilisateur //

function getAllUser(){
    $user=[];
    try{ 
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="SELECT * FROM projet.user";
        $req=$bdd->query($sqlReq); 
        $user=$req->fetchAll(PDO::FETCH_CLASS,'user');
        $req->closeCursor();
    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
        return $user;
    }

}

//----------------------------------------------------------//

//fonction qui retourne un USER



function getUser(int $id){
    $user=false;
    try{
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="SELECT * FROM projet.user WHERE id=:id";
        $req=$bdd->prepare($sqlReq);
        $req->bindValue(':id',$id,PDO::PARAM_INT);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS,"user");
        $user=$req->fetch();
        $req->closeCursor();
    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
    return $user;
    }

}

//fonction qui recupere le user avec le mail ;
//----------------------------------------------- 
function getUserByEmail(string $email){
    $user=false;
    try{
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="SELECT * FROM projet.user WHERE email=:email";
        $req=$bdd->prepare($sqlReq);
        $req->bindValue(':email',$email,PDO::PARAM_STR);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS,"user");
        $user=$req->fetch();
        $req->closeCursor();
    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
    return $user;
    }


}

//fONCTION QUI CREE USER
//----------------------------------------------- 

function createUser(user $user){
    $ret=false;
    try{
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="INSERT INTO projet.user(nom,prenom,email,password,statut)VALUE(:nom,:prenom,:email,:password,:statut)";
        $req=$bdd->prepare($sqlReq);
        $req->bindValue(':nom',$user->getNom(),PDO::PARAM_STR);
        $req->bindValue(':prenom',$user->getPrenom(),PDO::PARAM_STR);
        $req->bindValue(':email',$user->getEmail(),PDO::PARAM_STR);
        $req->bindValue(':password',$user->getPassword(),PDO::PARAM_STR);
        $req->bindValue(':statut',$user->getStatut(),PDO::PARAM_INT);
        $ret=$req->execute();
    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
        return $ret;
        }
}


//fonction qui supprime un user 
//------------------------------------------------------------

function deleteUser(int $id){
    $deleteUser=false;
    try{
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="DELETE FROM projet.user WHERE id=:id";
        $req=$bdd->prepare($sqlReq);
        $req->bindValue(':id',$id,PDO::PARAM_INT);
        $deleteUser=$req->execute();
    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
        return $deleteUser;
        }

}

//fonction qui met a jour un user 
//----------------------------------------------------------

function updateUser(user $user){
    $updateUser=false;
    try{
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="UPDATE projet.user SET nom=:nom,prenom=:prenom,email=:email,password=:password,statut=:statut WHERE id=:id";
        $req=$bdd->prepare($sqlReq);
        $req->bindValue(':id',$user->getId(),PDO::PARAM_INT);
        $req->bindValue(':nom',$user->getNom(),PDO::PARAM_STR);
        $req->bindValue(':prenom',$user->getPrenom(),PDO::PARAM_STR);
        $req->bindValue(':email',$user->getEmail(),PDO::PARAM_STR);
        $req->bindValue(':password',$user->getPassword(),PDO::PARAM_STR);
        $req->bindValue(':statut',$user->getStatut(),PDO::PARAM_INT);
        $updateUser=$req->execute();
    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
        return $updateUser;
        }

}

//fonction qui change un user en client
//----------------------------------------------------------
function change2client(int $clientId){
    $ret=false;

    try{
        $bdd= new PDO("mysql:host=localhost;dbname=projet;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sqlReq="UPDATE projet.user SET statut = 2";
        $sqlReq.=" WHERE id=:cId";
        $req=$bdd->prepare($sqlReq);
        $req->bindValue(':cId',$clientId,PDO::PARAM_INT);
        $ret=$req->execute();
    }
    catch(PDOExeption $ex){
        var_dump($ex->getmessage());
    }
    finally{
        return $ret;
    }


}

