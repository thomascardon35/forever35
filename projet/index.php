<?php

require_once 'models/newsEventsModel.php';

$newsEventsModel = new NewsEvents;
$newsEvents= $newsEventsModel->read();








$template="view/home";
include "view/layout.phtml";