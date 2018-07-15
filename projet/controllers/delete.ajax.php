<?php
session_start();

if (isset($_SESSION['login'])){//On vérifie que le variable existe.
    $login=$_SESSION['login'];//On récupère la valeur de la variable de session.
}else{
    $login=0;//Si $_SESSION['connect'] n'existe pas, on donne la valeur "0".
}

require_once '../models/messageModel.php';
require_once '../models/newsEventsModel.php';
require_once '../models/productModel.php';
require_once '../models/commentModel.php';

$messageModel = new Message;
$newsEventsModel = new NewsEvents;
$productModel = new Product;
$commentModel = new Comment;


if(array_key_exists('delete_message', $_GET)){

    $messageModel->delete(intval($_GET['delete_message']));


    $messages = $messageModel->read();

    echo json_encode($messages);
}


if(array_key_exists('delete_event', $_GET)){

    $newsEventsModel->delete(intval($_GET['delete_event']));

    $events = $newsEventsModel->read();

    echo json_encode($events);
}

if(array_key_exists('delete_product', $_GET)){

    $productModel->delete(intval($_GET['delete_product']));

    $products = $productModel->read();

    echo json_encode($products);
}

if(array_key_exists('delete_comm', $_GET)){
    
    // on supprime le commentaire
    $commentModel->delete(intval($_GET['delete_comm']));
    //on récupère la référence produit qui nous sert en argument pour "$commentModel->readCommentsJoinProducts"
    $refproduct = intval($_GET['refproduct']);
    // on récupère les données afin de les utliser en Ajax
    $comments = $commentModel->readCommentsJoinProducts($refproduct);

    echo json_encode($comments);

}