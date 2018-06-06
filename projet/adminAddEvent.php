<?php

require_once 'models/newsEventsModel.php';

// on instancie le modèle NewsEvents
$newsEventsModel = new NewsEvents;

//après le clique sur le btn submit
if(array_key_exists('addEvent', $_POST)){
    //Si le champ Description du formulaire est vide alors on affiche le message d'erreur et on n'enregistre pas en BDD
    if(empty($_POST['eventdescription'])){

        echo "<p class='error-message'>Attention, Vous n'avez pas rempli le champs Description :</p>";

    }else{
        //Si le champ minutes d'heure de RDV est vide alors le champ vaut 00
        if($_POST['appointementminutes'] == null){
            $_POST['appointementminutes'] = '00';
        }
        //Si le champ minutes d'heure de fin est vide alors le champ vaut 00
        if($_POST['endtimeminutes'] == null){
            $_POST['endtimeminutes'] = '00';
        }
        //Si le champ année de la date de RDV est vide alors le champ vaut l'année en cours
        if($_POST['year'] == null){
            $_POST['year'] = date("Y");
        }
        //Si le champ mois ou jour ou heure de RDV ou heure de fin est vide
        if($_POST['month'] == null && 
        $_POST['day'] == null && 
        $_POST['appointementhour'] == null && 
        $_POST['endtimehour'] == null){
            // alors la date/hr de RDV et hr de fin vaudront null
            $appointementDate=null;
            $endTimeEvent=null;

        }else{// sinon on récupère les champs tels qu'indiqués par l'admin
            $appointementDate   = $_POST['year'] . ":" . $_POST['month'] . ":" . $_POST['day'] . " " . $_POST['appointementhour'] . ":" .$_POST['appointementminutes'];
            $endTimeEvent       = $_POST['endtimehour'] . ":" . $_POST['endtimeminutes'];
        }
        //on récupère les champs tels qu'indiqués par l'admin
        $city               = trim($_POST['city']);
        $eventType          = trim($_POST['eventtype']);
        $eventDescription   = trim($_POST['eventdescription']);

        // on fait appel à la méthode create du modèle NewsEvents pour insérer en BDD
        $newsEventsModel->create($appointementDate,$endTimeEvent,$city,$eventType,$eventDescription);
        // et on redirige vers la page admin
        header('Location: admin.php');
        exit();
    }
};

if(array_key_exists('update_id', $_GET)){
    $newsEventsUpdate = $newsEventsModel->readById($_GET['update_id']);
}


if(array_key_exists('updateEvent', $_POST)){

    if(empty($_POST['eventdescription'])){

        echo "<p class='error-message'>Attention, Vous n'avez pas rempli le champs Description :</p>";

    }else{
        //Si le champ minutes d'heure de RDV est vide alors le champ vaut 00
        if($_POST['appointementminutes'] == null){
            $_POST['appointementminutes'] = '00';
        }
        //Si le champ minutes d'heure de fin est vide alors le champ vaut 00
        if($_POST['endtimeminutes'] == null){
            $_POST['endtimeminutes'] = '00';
        }
        //Si le champ année de la date de RDV est vide alors le champ vaut l'année en cours
        if($_POST['year'] == null){
            $_POST['year'] = date("Y");
        }
        //Si le champ mois ou jour ou heure de RDV ou heure de fin est vide
        if($_POST['month'] == null && 
        $_POST['day'] == null && 
        $_POST['appointementhour'] == null && 
        $_POST['endtimehour'] == null){
            // alors la date/hr de RDV et hr de fin vaudront null
            $appointementDate=null;
            $endTimeEvent=null;

        }else{// sinon on récupère les champs tels qu'indiqués par l'admin
            $appointementDate   = $_POST['year'] . ":" . $_POST['month'] . ":" . $_POST['day'] . " " . $_POST['appointementhour'] . ":" .$_POST['appointementminutes'];
            $endTimeEvent       = $_POST['endtimehour'] . ":" . $_POST['endtimeminutes'];
        }
        //on récupère les champs tels qu'indiqués par l'admin
        $city               = trim($_POST['city']);
        $eventType          = trim($_POST['eventtype']);
        $eventDescription   = trim($_POST['eventdescription']);
        $id                 = $_POST['id'];
        
        // on fait appel à la méthode update du modèle NewsEvents pour changer cette newsevents en BDD
        $i=$newsEventsModel->update($appointementDate,$endTimeEvent,$city,$eventType,$eventDescription,$id);
        // et on redirige vers la page admin
        header('Location: admin.php');
        exit();
    }
}


if(array_key_exists('delete_id', $_POST)){ 

    $newsEventsModel->delete([$_POST['id']]); // on utlilise la méthode delete de newsEventsModel

    header('Location: admin.php');
    exit();
}





$template="view/adminAddEvent";
include "view/layout.phtml";