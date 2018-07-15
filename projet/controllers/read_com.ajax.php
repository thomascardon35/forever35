<?php
session_start();

if (isset($_SESSION['login'])){//On vérifie que le variable existe.
    $login=$_SESSION['login'];//On récupère la valeur de la variable de session.
}else{
    $login=0;//Si $_SESSION['connect'] n'existe pas, on donne la valeur "0".
}

require_once '../models/commentModel.php';
$commentModel = new Comment;


if(array_key_exists('read_comments', $_GET)){

    $comments = $commentModel->readCommentsJoinProducts(intval($_GET['read_comments']));

    echo json_encode($comments);

}