<?php

require_once 'models/newsEventsModel.php';
require_once 'models/productModel.php';
require_once 'models/commentModel.php';
require_once 'models/errorModel.php';

$errorModel = new Error;

$newsEventsModel = new NewsEvents;
$newsEvents = $newsEventsModel->read();

$commentModel = new Comment;


if(array_key_exists('read_ref', $_GET)){
    $productModel = new Product;
    $productsById = $productModel->readByRef($_GET['read_ref']);

    $comments = $commentModel->readCommentsJoinProducts($_GET['read_ref']);

}else{
    header('Location: products.php');
    exit();
}


if(array_key_exists('addComment', $_POST)){

    $refProduct         = intval($_POST ['refproduct']);
    $email              = trim($_POST['email']);
    $pseudo             = trim($_POST['pseudo']);
    $satisfaction       = trim($_POST['satisfaction']);
    $userComment        = trim($_POST['usercomment']);

    try{
        
        $commentModel->create($refProduct,$email,$pseudo,$satisfaction,$userComment);

    }catch (DomainException $error){
        $errorModel->setErrorMessage($error->getMessage());
    }
}



$template="view/product";
include "view/layout.phtml";