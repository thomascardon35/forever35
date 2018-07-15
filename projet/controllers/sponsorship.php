<?php
session_start();

if (isset($_SESSION['login'])){//On vérifie que le variable existe.
    $login=$_SESSION['login'];//On récupère la valeur de la variable de session.
}else{
    $login=0;//Si $_SESSION['connect'] n'existe pas, on donne la valeur "0".
}

require_once '../models/newsEventsModel.php';

$newsEventsModel = new NewsEvents;
//les mois écrits en français dans un tableau afin d'éviter le bug des mois écrits en anglais,
// malgré le " PDO::MYSQL_ATTR_INIT_COMMAND => "SET lc_time_names = 'fr_FR'" " indiqué dans databaseClass.php
$months = ["janvier","février","mars","avril","mai","juin","juillet","août","septembre","octobre","novembre","décembre"];

$newsEvents= $newsEventsModel->read();











$template="../view/sponsorship";
include "../view/layout.phtml";