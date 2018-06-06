<?php

require_once 'models/newsEventsModel.php';

$newsEventsModel = new NewsEvents;
$newsEvents= $newsEventsModel->read();










$template="view/standards";
include "view/layout.phtml";