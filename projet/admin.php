<?php
session_start();

if (isset($_SESSION['login'])){//On vérifie que le variable existe.
    $login=$_SESSION['login'];//On récupère la valeur de la variable de session.
}else{
    $login=0;//Si $_SESSION['connect'] n'existe pas, on donne la valeur "0".
}


if ($login == "1"){ // Si le visiteur s'est identifié, on affiche la page

    require_once 'models/newsEventsModel.php';
    require_once 'models/messageModel.php';

    $newsEventsModel = new NewsEvents;
    $newsEvents= $newsEventsModel->read();
    
    $messageModel = new Message;
    $messages = $messageModel->read();


    if(array_key_exists('delete_id', $_GET)){  // ici on récupère l'information de la query string delete_id = le clique sur la poubelle

        $newsEventsModel->delete([$_GET['delete_id']]); // on utlilise la méthode delete de newsEventsModel

        header('Location: admin.php');
        exit();
    }


    

    if(array_key_exists('logout', $_POST)){
        $_SESSION = [];

        if (isset($_COOKIE[session_name()])){
            setcookie(session_name(),'',time()-4200,'/');
        }

        session_destroy();
    }

    $template="view/admin";
    include "view/layout.phtml";

}else{
    header('Location: adminlogIn.php');
    exit();
}