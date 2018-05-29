<?php

include 'models/newsEventsModel.php';


/*$sql = 'SELECT DAY(appointementdate)AS day,MONTH(appointementdate)AS month,YEAR(appointementdate)AS year,HOUR(appointementdate)AS hour,MINUTE(appointementdate)AS minute,city ,eventdescription,eventtype
        FROM newsevents' ;


$ressource = $pdo->prepare($sql);
$ressource->execute();
$newsevents = $ressource->fetchAll(PDO::FETCH_ASSOC); */

$newsEventsModel = new newsEventsModel;
$newsEvents= $newsEventsModel->read();

var_dump($newsEventsModel->read());

$template="view/home";
include "view/layout.phtml";