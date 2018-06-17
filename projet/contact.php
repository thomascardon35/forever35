<?php

require_once 'models/newsEventsModel.php';
require_once 'models/messageModel.php';

$newsEventsModel = new NewsEvents;
$newsEvents= $newsEventsModel->read();

$messageModel = new Message;

if(array_key_exists('submitMessage',$_POST)){
    $gender             = ($_POST['gender']);
    $firstName          = trim($_POST['firstname']);
    $lastName           = trim($_POST['lastname']);
    $zipCode            = $_POST['zipcode'];
    $city               = trim($_POST['city']);
    $phone              = $_POST['phone'];
    $email              = trim($_POST['email']);
    $subjectMessage     = $_POST['subjectmessage'];
    $userMessage        = trim($_POST['usermessage']);

    try{
        $messageModel->create($gender,$firstName,$lastName,$zipCode,$city,$phone,$email,$subjectMessage,$userMessage);
        
    }catch (DomainException $error){
        $messageModel->setErrorMessage($error->getMessage());
    }

}; 



$template="view/contact";
include "view/layout.phtml";