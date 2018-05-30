<?php

require_once 'models/newsEventsModel.php';

$newsEventsModel = new newsEventsModel;
$newsEvents= $newsEventsModel->read();




/*$sql = 'SELECT DAY(appointementdate)AS day,MONTH(appointementdate)AS month,YEAR(appointementdate)AS year,HOUR(appointementdate)AS hour,MINUTE(appointementdate)AS minute,city ,eventdescription,eventtype
        FROM newsevents' ;


$ressource = $pdo->prepare($sql);
$ressource->execute();
$newsevents = $ressource->fetchAll(PDO::FETCH_ASSOC); */


$template="view/home";
include "view/layout.phtml";