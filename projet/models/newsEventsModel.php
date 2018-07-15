<?php

require_once '../config/databaseClass.php';

class NewsEvents{
    private $db;

    function __construct(){
        $this->db = new Database;
    }

    function create($appointementDate,$endTimeEvent,$city,$eventType,$eventDescription){

        $sql = 'INSERT INTO newsevents(appointementdate,endtimeevent,city,eventtype,eventdescription)
                VALUES (?,?,?,?,?)';
                
        $newsEvent = $this->db->executeSql($sql,[$appointementDate,$endTimeEvent,$city,$eventType,$eventDescription]);
    }
    
    function read(){
        $sql = 'SELECT id, DATE_FORMAT(appointementdate,"%e") AS eventday, DATE_FORMAT(appointementdate,"%c") AS eventmonth ,DATE_FORMAT(appointementdate,"%Y") AS eventyear , DATE_FORMAT(appointementdate,"%H:%i") AS eventtime,TIME_FORMAT(endtimeevent,"%H:%i") AS endtime,city ,eventdescription,eventtype
        FROM newsevents
        ORDER BY appointementdate' ;

        return $this->db->query($sql);
    }

    function readById($id){
        $sql = 'SELECT id,DATE_FORMAT(appointementdate,"%d") AS eventday,DATE_FORMAT(appointementdate,"%m") AS eventmonth,DATE_FORMAT(appointementdate,"%Y") AS eventyear,DATE_FORMAT(appointementdate,"%H") AS eventhour,DATE_FORMAT(appointementdate,"%i") AS eventminutes, TIME_FORMAT(endtimeevent,"%H") AS endtimehour,TIME_FORMAT(endtimeevent,"%i") AS endtimeminutes, city, eventtype, eventdescription
        FROM newsevents
        WHERE id = ?' ;

        return $this->db->queryOne($sql,[$id]);
    }

    function delete($id){
        $sql = 'DELETE FROM newsevents WHERE id=?';

        $this->db->executeSql($sql,[$id]);
    }

    function update($appointementDate,$endTimeEvent,$city,$eventType,$eventDescription,$id){

        $sql = 'UPDATE newsevents
                SET appointementdate = ?,
                endtimeevent = ?,
                city = ?,
                eventtype = ?,
                eventdescription = ?
                WHERE id = ?';


        $newsEventUpdate = $this->db->executeSql($sql,[$appointementDate,$endTimeEvent,$city,$eventType,$eventDescription,$id]);
        
    }
}