<?php


include 'config/database.php';


$sql = 'SELECT appointementdate ,city ,description,eventtype
        FROM newsevents' ;


$ressource = $pdo->prepare($sql);
$ressource->execute();
$newsevents = $ressource->fetchAll(PDO::FETCH_ASSOC);





$template="view/home";
include "view/layout.phtml";