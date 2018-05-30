<?php

require_once 'config/databaseClass.php';

class newsEventsModel{
    private $db;

    function __construct(){
        $this->db = new Database;
    }

    function create($appointementDate,$endTimeEvent,$city,$eventType,$eventDescription){
        
        if(empty($eventDescription)){
            echo("Vous n'avez pas rempli le champs description");
        }else{

            $sql = 'INSERT INTO newsevents(appointementdate,endtimeevent,city,eventtype,eventdescription)
                    VALUES (?,?,?,?,?)';
                
            $newsEvent = $this->db->executeSql($sql,[$appointementDate,$endTimeEvent,$city,$eventType,$eventDescription]);
        }
    }
    
    function read(){
        $sql = 'SELECT id, DATE_FORMAT(appointementdate,"%e %M %Y") AS eventdate, DATE_FORMAT(appointementdate,"%H:%i") AS eventtime,city ,eventdescription,eventtype
        FROM newsevents' ;

        return $this->db->query($sql);
    }

    function delete($id){
        $sql = 'DELETE FROM newsevents WHERE id=?';

        $this->db->executeSql($sql,$id);
    }

    function update(){

    }
}


/* DAY(appointementdate)AS day,MONTH(appointementdate)AS month,YEAR(appointementdate)AS year, HOUR(appointementdate)AS hour,MINUTE(appointementdate)AS minute */