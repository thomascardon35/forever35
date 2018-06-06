<?php

require_once 'models/newsEventsModel.php';

$newsEventsModel = new NewsEvents;
$newsEvents= $newsEventsModel->read();



if(array_key_exists('delete_id', $_GET)){  // ici on récupère l'information de la query string delete_id = le clique sur la poubelle

    $newsEventsModel->delete([$_GET['delete_id']]); // on utlilise la méthode delete de newsEventsModel

    header('Location: admin.php');
    exit();
}









$template="view/admin";
include "view/layout.phtml";