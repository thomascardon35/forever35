<?php
session_start();

if (isset($_SESSION['login'])){//On vérifie que le variable existe.
    $login=$_SESSION['login'];//On récupère la valeur de la variable de session.
}else{
    $login=0;//Si $_SESSION['connect'] n'existe pas, on donne la valeur "0".
}

if ($login == "1"){ // Si le visiteur s'est identifié, on affiche la page

    require_once '../models/loginAdminModel.php';
    require_once '../models/errorModel.php';

    $loginAdmin = new loginAdmin;
    $errorModel = new ErrorModel;

    $loginVerify = false ; 
    $loginChange = false ;

    if (array_key_exists('current_password', $_POST)) { // Click sur Connexion
        // on récupère les valeurs des champs pseudo et password
        $pseudo   = htmlspecialchars(trim($_POST['pseudo']));
        $password = htmlspecialchars(trim($_POST['password']));

        try {
            // si l'un des deux champs ou les deux champs sont vides = message d'erreur
            if (empty($pseudo) || empty($password)) throw new DomainException('Tous les champs doivent être remplis');
            // on enregstre dans $login le booleen de la méthode login de la classe loginAdmin
            $loginVerify = $loginAdmin->login($pseudo, $password);

        }catch (DomainException $error){
            $errorModel->setErrorMessage($error->getMessage());

        }
    }

    if (array_key_exists('new_password', $_POST)) { // Click sur Modifier
        // on récupère les valeurs des champs pseudo et password
        $id          = intval($_SESSION['id']);
        $newPseudo   = htmlspecialchars(trim($_POST['pseudo']));
        $newPassword = htmlspecialchars(trim($_POST['password']));

        try {
            // si l'un des deux champs ou les deux champs sont vides = message d'erreur
            if (empty($newPseudo) || empty($newPassword)) throw new DomainException('Tous les champs doivent être remplis');
            // on enregstre dans $login le booleen de la méthode login de la classe loginAdmin
            $loginChange = $loginAdmin->update($newPseudo, $newPassword, $id);

        }catch (DomainException $error){
            $errorModel->setErrorMessage($error->getMessage());

        }

    }

}

$template="../view/admin_update_login";
include "../view/layout.phtml";