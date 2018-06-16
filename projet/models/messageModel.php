<?php

require_once 'config/databaseClass.php';

class Message{
    private $db;

    function __construct(){
        $this->db = new Database;
    }

    function create($gender,$firstName,$lastName,$zipCode,$city,$phone,$email,$subjectMessage,$userMessage){
       
        $sql = 'INSERT INTO contactmessage(datemessage,gender,firstname,lastname,zipcode,city,phone,email,subjectmessage,usermessage)
                VALUES (NOW(),?,?,?,?,?,?,?,?,?)';
                
        $newsEvent = $this->db->executeSql($sql,[$gender,$firstName,$lastName,$zipCode,$city,$phone,$email,$subjectMessage,$userMessage]);
        
    }

    function read(){
       
        $sql = 'SELECT id, DATE_FORMAT(datemessage,"%e %M %Y") AS sendingdate, DATE_FORMAT(datemessage,"%H:%i") AS sendingtime,gender,firstname,lastname,zipcode,city,phone,email,subjectmessage,usermessage
                FROM contactmessage
                ORDER BY  datemessage DESC';
                
        
        return $this->db->query($sql);
        
    }

    function readById($id){
        $sql = 'SELECT id,DATE_FORMAT(datemessage,"%e %M %Y") AS sendingdate, DATE_FORMAT(datemessage,"%H:%i") AS sendingtime,gender,firstname,lastname,zipcode,city,phone,email,subjectmessage,usermessage
        FROM contactmessage
        WHERE id = ?' ;

        return $this->db->queryOne($sql,[$id]);
    }


    function delete($id){
        $sql = 'DELETE FROM contactmessage WHERE id=?';

        $this->db->executeSql($sql,[$id]);
    }
}