<?php

require_once 'models/newsEventsModel.php';
require_once 'models/messageModel.php';


$newsEventsModel = new NewsEvents;
$newsEvents= $newsEventsModel->read();


if(array_key_exists('submitMessage',$_POST)){

    $messageModel = new Message;

    if(empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['zipcode']) || empty($_POST['email']) || empty($_POST['subjectmessage']) || empty($_POST['usermessage'])){

        echo("Vous n'avez pas rempli les champs obligatoires * ");

    }else{

        $gender             = ($_POST['gender']);
        $firstName          = trim($_POST['firstname']);
        $lastName           = trim($_POST['lastname']);
        $zipCode            = trim($_POST['zipcode']);
        $city               = trim($_POST['city']);
        $phone              = trim($_POST['phone']);
        $email              = trim($_POST['email']);
        $subjectMessage     = $_POST['subjectmessage'];
        $userMessage        = trim($_POST['usermessage']);


        $messageModel->create($gender,$firstName,$lastName,$zipCode,$city,$phone,$email,$subjectMessage,$userMessage);
    }
}









$template="view/contact";
include "view/layout.phtml";