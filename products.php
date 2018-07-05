<?php


require_once 'models/newsEventsModel.php';
require_once 'models/productModel.php';

$newsEventsModel = new NewsEvents;
$newsEvents= $newsEventsModel->read();

$productModel = new Product;

$newProducts            = $productModel->readByCategory('Nouveautés');
$healthProducts         = $productModel->readByCategory('Santé');
$painProducts           = $productModel->readByCategory('Douleur');
$skinProducts           = $productModel->readByCategory('Peau');
$dailyProducts          = $productModel->readByCategory('Quotidien');
$houseAnimalsProducts   = $productModel->readByCategory('Maison Animaux');









$template="view/products";
include "view/layout.phtml";