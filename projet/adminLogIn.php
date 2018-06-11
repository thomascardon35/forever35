<?php
session_start();
$_SESSION['login']=0; //On initialise la variable 'login'.

if (isset($_POST['password']) AND isset($_POST['id'])){ // Si les variables existent.

    $password=$_POST['password'];
    $id=$_POST['id']; // Alors On récupère les données envoyées dans le formulaire de connexion.

}else{ // Les variables n'existent pas encore.
    $password="";
    $id=""; // On crée des variables $password  et $id vides.
}

if (($password == "admin" AND $id == "admin")){
// Si le password et le id sont bons .
    $_SESSION['login']=1; // la variable login prend la valeur 1 pour indiquer la connexion
    $_SESSION['id']=$id; //On récupère l' id afin de personnaliser la navigation.

    header('Location:admin.php'); // on envoie vers la page admin sécurisée
    exit;

}else{ // Et si le mot de passe est faux.
    $template="view/adminLogIn"; // on redirige vers la page d'authentification
}


$template="view/adminLogIn";
include "view/layout.phtml";