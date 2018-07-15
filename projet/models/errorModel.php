<?php

/* require_once '../config/databaseClass.php'; */

class ErrorModel{/* 
    private $db; */

    function __construct(){
        $this->errorMessage = null;
    }

    function getErrorMessage() {
        return $this->errorMessage;
    }

    function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
    }
}