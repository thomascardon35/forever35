<?php

require_once 'models/newsEventsModel.php';

$newsEventsModel = new newsEventsModel;
$newsEvents= $newsEventsModel->read();











$template="view/contact";
include "view/layout.phtml";