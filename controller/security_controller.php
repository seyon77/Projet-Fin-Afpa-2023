<?php

require_once "model/user.php";

function loginUser(){
    require "view/login_Form.php";

}

function createCartUser(){
    if(!isset($_SESSION['comptes'])){
        $_SESSION['comptes']=[];
    } 
}

function traitementConnexion(){
    createCartUser();
    $allUser=getAllUser();
    $_SESSION['comptes']=$allUser;
    foreach($allUser as $user){
        $userMail=$user->getEmail();
        $userPasswd=$user->getPassword();

        if(isset($_POST['emailSign'])) {
            $mailSign=htmlspecialchars($_POST['emailSign']);
            $mdpSign=htmlspecialchars($_POST['passwdSign']);

            if($mailSign==$userMail){
                if(password_verify($mdpSign,$userPasswd)){
             $_SESSION['utilisateur']=[];
             $_SESSION['utilisateur']['fullName']=$user->getFullName();
             $_SESSION['utilisateur']['statut']=$user->getStatut();
             $_SESSION['utilisateur']['id']=$user->getId();

                

                header('location:http://localhost/projet/index.php?action=home');
                break;
                
            }else{
                $_SESSION['notFound']=[];

                header('location:http://localhost/projet/index.php?action=loginUser');
                
            }
            }
        }
    }
}


function showAllUserStatut(){
    $user=getAllUserStatut();
    require "view/user_view.php";
}

function addUserForm(){
    $statut=getAllStatuts();
    if(isset ($_GET['mode'])){
        $mode= $_GET['mode'];
        if ($mode ==='create'){

            require "view/user_form.php";
        }
        else{
            $userId=intval($_GET['id']);
            $user= getUser($userId);
            require "view/user_form.php";      
        }
    }
}

function addUserBdd(){
    if (isset($_POST['nomUser'])){
    $user=new User();
    $user->setNom(htmlspecialchars($_POST['nomUser']));
    $user->setPrenom(htmlspecialchars($_POST['prenomUser']));
    $user->setEmail(htmlspecialchars($_POST['emailUser']));
    $user->setPassword(password_hash(htmlspecialchars($_POST['passwdUser']),PASSWORD_DEFAULT));
    $user->setStatut(1);
    $ret=createUser($user);
    header('location:http://localhost/projet/index.php?action=home');
    }
}

function updUserbdd(){
    if (isset($_POST['nomUser'])){
    $user=getUser($_GET['id']);
    $user->setNom(htmlspecialchars($_POST['nomUser']));
    $user->setPrenom(htmlspecialchars($_POST['prenomUser']));
    $user->setEmail(htmlspecialchars($_POST['emailUser']));
    $user->setPassword(password_hash(htmlspecialchars($_POST['passwdUser']),PASSWORD_DEFAULT));
    $user->setStatut(htmlspecialchars($_POST['statutUser']));
    $ret=updateUser($user);
    header('location:http://localhost/projet/index.php?action=ShowAllUser');
    
    }
}

function delUserBdd(){
    if(isset($_GET['id'])){
        $id=intval(htmlspecialchars($_GET['id']));
        $ret=deleteUser($id);
        header('location:http://localhost/projet/index.php?action=ShowAllUser');

    }
}

function delUserSession(){
    if(($_SESSION['utilisateur'])){
        unset($_SESSION['utilisateur']);
        unset($_SESSION['notFound']);
    }
    header("location:http://localhost/projet/index.php?action=home");

}