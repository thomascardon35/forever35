<?php

require_once 'models/messageModel.php';
$messageModel = new Message;

require_once 'models/newsEventsModel.php';
$newsEventsModel = new NewsEvents;

require_once 'models/productModel.php';
$productModel = new Product;


if(array_key_exists('delete_message', $_GET)){

    $messageModel->delete($_GET['delete_message']);


    $messages = $messageModel->read();

    echo json_encode($messages);
}


if(array_key_exists('delete_event', $_GET)){

    $newsEventsModel->delete($_GET['delete_event']);

    $events = $newsEventsModel->read();

    echo json_encode($events);
}

if(array_key_exists('delete_product', $_GET)){

    $productModel->delete($_GET['delete_product']);

    $products = $productModel->read();

    echo json_encode($products);
}