<?php
session_start();

if (isset($_SESSION['login'])){//On vérifie que le variable existe.
    $login=$_SESSION['login'];//On récupère la valeur de la variable de session.
}else{
    $login=0;//Si $_SESSION['connect'] n'existe pas, on donne la valeur "0".
}


require_once '../models/newsEventsModel.php';
require_once '../models/productModel.php';
require_once '../models/errorModel.php';
require_once '../models/commentModel.php';

$errorModel = new ErrorModel;
$newsEventsModel = new NewsEvents;
$commentModel = new Comment;

//les mois écrits en français dans un tableau afin d'éviter le bug des mois écrits en anglais,
// malgré le " PDO::MYSQL_ATTR_INIT_COMMAND => "SET lc_time_names = 'fr_FR'" " indiqué dans databaseClass.php
$months = ["janvier","février","mars","avril","mai","juin","juillet","août","septembre","octobre","novembre","décembre"];

$newsEvents = $newsEventsModel->read();


if(array_key_exists('read_ref', $_GET)){
    $productModel = new Product;
    
    $refproduct = intval($_GET['read_ref']);

    $productsById = $productModel->readByRef($refproduct);

    $comments = $commentModel->readCommentsJoinProducts($refproduct);

}else{
    header('Location: products');
    exit();
}


if(array_key_exists('addComment', $_POST)){

    $refProduct         = intval($_POST ['refproduct']);
    $email              = htmlspecialchars(trim($_POST['email']));
    $pseudo             = htmlspecialchars(trim($_POST['pseudo']));
    $satisfaction       = htmlspecialchars(trim($_POST['satisfaction']));
    $userComment        = htmlspecialchars(trim($_POST['usercomment']));

    try{
        
        $commentModel->create($refProduct,$email,$pseudo,$satisfaction,$userComment);

    }catch (DomainException $error){
        $errorModel->setErrorMessage($error->getMessage());
    }
}


if(array_key_exists('delete_comm', $_POST)){
    
    $commentModel->delete(intval($_POST['id'])); 

    header('Location: product-' . intval($_POST['refproduct']));
    exit();
}

$template="../view/product";
include "../view/layout.phtml";