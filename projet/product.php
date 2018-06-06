<?php


require_once 'models/newsEventsModel.php';

$newsEventsModel = new NewsEvents;
$newsEvents= $newsEventsModel->read();











$template="view/product";
include "view/layout.phtml";