<?php
session_start();

if (isset($_SESSION['login'])){//On vérifie que le variable existe.
    $login=$_SESSION['login'];//On récupère la valeur de la variable de session.
}else{
    $login=0;//Si $_SESSION['connect'] n'existe pas, on donne la valeur "0".
}


if ($login == "1"){ // Si le visiteur s'est identifié, on affiche la page

    require_once '../models/messageModel.php';

    //les mois écrits en français dans un tableau afin d'éviter le bug des mois écrits en anglais,
    // malgré le " PDO::MYSQL_ATTR_INIT_COMMAND => "SET lc_time_names = 'fr_FR'" " indiqué dans databaseClass.php
    $months = ["janvier","février","mars","avril","mai","juin","juillet","août","septembre","octobre","novembre","décembre"];
    
    // on instancie le modèle Message
    $messageModel = new Message;

    //après le clique sur un lien appelant la query string 'read_message'
    if(array_key_exists('read_message', $_GET)){
        // on fait appel à la méthode readById de Message
        $readMessage = $messageModel->readById(intval($_GET['read_message']));
    }

    if(array_key_exists('delete_message', $_GET)){
        // on fait appel à la méthode delete de Message
        $readMessage = $messageModel->delete(intval($_GET['delete_message']));
        
        header('Location: admin');
        exit();
    }
    

    if(array_key_exists('logout', $_POST)){
        $_SESSION = [];

        if (isset($_COOKIE[session_name()])){
            setcookie(session_name(),'',time()-4200,'/');
        }

        session_destroy();
    }

    $template="../view/admin_message";
    include "../view/layout.phtml";

}else{
    header('Location: log');
    exit();
}