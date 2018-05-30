<?php

require_once 'models/newsEventsModel.php';

$newsEventsModel = new newsEventsModel;
$newsEvents= $newsEventsModel->read();










$template="view/standards";
include "view/layout.phtml";