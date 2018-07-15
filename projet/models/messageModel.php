<?php

require_once '../config/databaseClass.php';

class Message{
    private $db;

    function __construct(){
        $this->db = new Database;
    }


    function create($gender,$firstName,$lastName,$zipCode,$city,$phone,$email,$subjectMessage,$userMessage){
        
        if(empty($firstName) || empty($lastName) || empty($zipCode)  || empty($email)  || empty($subjectMessage) || empty($userMessage)) throw new DomainException("Tous les champs marqués d'un * doivent être remplis.");

        if (!ctype_digit($zipCode) || strlen($zipCode) != 5) throw new DomainException("Le code postal doit contenir 5 chiffres.");

        if($phone != null && strlen($phone) != 10) throw new DomainException("Le numéro de téléphone doit contenir 10 chiffres.");
        
        if ($phone != null){
            if(!ctype_digit($phone)) throw new DomainException("Le numéro de téléphone ne doit contenir que des chiffres.");
        }else{
            $phone = 0;
        }

        if (!preg_match('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD' , $email)) throw new DomainException("Veuillez indiquer un E-mail valide .");


        if(strlen($firstName) > 64)
        throw new DomainException("Le Prénom ne peut pas contenir plus de 64 caractères.");
        if(strlen($lastName) > 64)
        throw new DomainException("Le Nom de famille ne peut pas contenir plus de 64 caractères.");
        if(strlen($city) > 64)
        throw new DomainException("La Ville dépasse la limite de 64 caractères.");
        if(strlen($email) > 128)
        throw new DomainException("L'E-mail dépasse la limite de 128 caractères.");
        if(strlen($userMessage) > 1024)
        throw new DomainException("Le message dépasse la limite de 1024 caractères.");

        $sql = 'INSERT INTO contactmessage(datemessage,gender,firstname,lastname,zipcode,city,phone,email,subjectmessage,usermessage)
                VALUES (NOW(),?,?,?,?,?,?,?,?,?)';
                
        $this->db->executeSql($sql,[$gender,$firstName,$lastName,$zipCode,$city,$phone,$email,$subjectMessage,$userMessage]);
        
    }

    function read(){
       
        $sql = 'SELECT id, DATE_FORMAT(datemessage,"%e") AS sendingday, DATE_FORMAT(datemessage,"%c") AS sendingmonth, DATE_FORMAT(datemessage,"%Y") AS sendingyear, DATE_FORMAT(datemessage,"%H:%i") AS sendingtime,gender,firstname,lastname,zipcode,city,phone,email,subjectmessage,usermessage
                FROM contactmessage
                ORDER BY  datemessage DESC';
                
        
        return $this->db->query($sql);
        
    }

    function readById($id){
        $sql = 'SELECT id, DATE_FORMAT(datemessage,"%e") AS sendingday, DATE_FORMAT(datemessage,"%c") AS sendingmonth, DATE_FORMAT(datemessage,"%Y") AS sendingyear, DATE_FORMAT(datemessage,"%H:%i") AS sendingtime,gender,firstname,lastname,zipcode,city,phone,email,subjectmessage,usermessage
        FROM contactmessage
        WHERE id = ?' ;

        return $this->db->queryOne($sql,[$id]);
    }

    function delete($id){
        $sql = 'DELETE FROM contactmessage WHERE id=?';

        $this->db->executeSql($sql,[$id]);
    }

};