<?php

include 'config/database.php';

class newsEventsModel{
    private $db;

    function __construct(){
        $this->db = new Database;
    }
    
    function read(){
        $sql = 'SELECT DAY(appointementdate)AS day,MONTH(appointementdate)AS month,YEAR(appointementdate)AS year,HOUR(appointementdate)AS hour,MINUTE(appointementdate)AS minute,city ,eventdescription,eventtype
        FROM newsevents' ;

        return $this->db->query($sql);
    }
}
