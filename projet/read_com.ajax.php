<?php

require_once 'models/commentModel.php';
$commentModel = new Comment;


if(array_key_exists('read_comments', $_GET)){

    $comments = $commentModel->readCommentsJoinProducts($_GET['read_comments']);

    echo json_encode($comments);

}