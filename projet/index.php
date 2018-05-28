<?php


/* include 'config/database.php';


$sql = 'SELECT DAY(appointementdate)AS day,MONTH(appointementdate)AS month,YEAR(appointementdate)AS year,HOUR(appointementdate)AS hour,MINUTE(appointementdate)AS minute,city ,eventdescription,eventtype
        FROM newsevents' ;


$ressource = $pdo->prepare($sql);
$ressource->execute();
$newsevents = $ressource->fetchAll(PDO::FETCH_ASSOC); */

/* <?php foreach($newsevents as $newsevent): ?>
            <ul>
                <li>Le <?= $newsevent['day'] . '/' . $newsevent['month']. '/' . $newsevent['year']?> à <?= $newsevent['hour'] . 'h' . $newsevent['minute']?> </li>
                <li class="<?= $newsevent['city']?>">A <?= substr($newsevent['city'],0,2);?></li>
                <li><?= $newsevent['eventdescription']?></li>
            </ul>
        <?php endforeach; ?> */

/* <?php foreach($newsevents as $newsevent): ?>
                <p><?= $newsevent['description']?></p>
            <?php endforeach; ?> */



$template="view/home";
include "view/layout.phtml";