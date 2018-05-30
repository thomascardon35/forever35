<?php

require_once 'models/newsEventsModel.php';

$newsEventsModel = new newsEventsModel;
$newsEvents= $newsEventsModel->read();

if(array_key_exists('delete_id', $_POST)){
    //TODO
}









$template="view/admin";
include "view/layout.phtml";