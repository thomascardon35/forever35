<?php
session_start();
$_SESSION['login']=0; //On initialise la variable 'login'.

require_once 'models/loginAdminModel.php';
require_once 'models/errorModel.php';

$loginAdmin = new loginAdmin;
$errorModel = new Error;


if (array_key_exists('connexion', $_POST)) { // Click sur Connexion
    // on récupère les valeurs des champs pseudo et password
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];

    try {
        // si l'un des deux champs ou les deux champs sont vides = message d'erreur
        if (empty($pseudo) || empty($password)) throw new DomainException('Tous les champs doivent être remplis');
        // on enregstre dans $login le booleen de la méthode login de la classe loginAdmin
        $login = $loginAdmin->login($pseudo, $password);

        // Si la variable $login == true .
        if($login == true ){
            $_SESSION['login']=1; // la variable login prend la valeur 1 pour indiquer la connexion
            $_SESSION['pseudo']=$pseudo; //On récupère l'id afin de personnaliser la navigation (si besoin).
            $_SESSION['id'] = $login['id'];
        
            header('Location:admin.php'); // on envoie vers la page admin sécurisée
            exit;
        }else{// sinon on redirige vers cette même page
            header('Location:admin_login.php'); 
            // toutes les erreurs possibles sont déja gérées avec "throw new DomainException" mais on préfère assurer.
            exit;
        }

    }catch (DomainException $error){
        $errorModel->setErrorMessage($error->getMessage());

    }
}


$template="view/admin_login";
include "view/layout.phtml";