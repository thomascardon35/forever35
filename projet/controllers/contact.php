<?php
session_start();

if (isset($_SESSION['login'])){//On vérifie que le variable existe.
    $login=$_SESSION['login'];//On récupère la valeur de la variable de session.
}else{
    $login=0;//Si $_SESSION['connect'] n'existe pas, on donne la valeur "0".
}

require_once '../models/newsEventsModel.php';
require_once '../models/messageModel.php';
require_once '../models/errorModel.php';

$newsEventsModel = new NewsEvents;

//les mois écrits en français dans un tableau afin d'éviter le bug des mois écrits en anglais,
// malgré le " PDO::MYSQL_ATTR_INIT_COMMAND => "SET lc_time_names = 'fr_FR'" " indiqué dans databaseClass.php
$months = ["janvier","février","mars","avril","mai","juin","juillet","août","septembre","octobre","novembre","décembre"];

$newsEvents= $newsEventsModel->read();

$messageModel = new Message;

$errorModel = new ErrorModel;

if(array_key_exists('submitMessage',$_POST)){
    $gender             = htmlspecialchars($_POST['gender']);
    $firstName          = htmlspecialchars(trim($_POST['firstname']));
    $lastName           = htmlspecialchars(trim($_POST['lastname']));
    $zipCode            = htmlspecialchars(trim($_POST['zipcode'])); // malgré des chiffres attendus dans cet input on précise htmlspecialchars parce que intval ne prend pas en compte les 0 en début de champ
    $city               = htmlspecialchars(trim($_POST['city']));
    $phone              = htmlspecialchars(trim($_POST['phone'])); // malgré des chiffres attendus dans cet input on précise htmlspecialchars parce que intval ne prend pas en compte les 0 en début de champ
    $email              = htmlspecialchars(trim($_POST['email']));
    $subjectMessage     = htmlspecialchars(trim($_POST['subjectmessage']));
    $userMessage        = htmlspecialchars(trim($_POST['usermessage']));

    try{
        $messageModel->create($gender,$firstName,$lastName,$zipCode,$city,$phone,$email,$subjectMessage,$userMessage);
        
    }catch (DomainException $error){
        $errorModel->setErrorMessage($error->getMessage());
    }

}; 



$template="../view/contact";
include "../view/layout.phtml";