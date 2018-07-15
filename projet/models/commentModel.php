<?php

require_once '../config/databaseClass.php';

class Comment{
    private $db;

    function __construct(){
        $this->db = new Database;
    }

    function create($refProduct,$email,$pseudo,$satisfaction,$userComment){

        if(empty($email) || empty($pseudo) || empty($satisfaction) || empty($userComment))
        throw new DomainException("Tous les champs d'ajout d'un commentaire sont requis");

        if (!preg_match('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD' , $email)) throw new DomainException("Veuillez indiquer un E-mail valide .");

        if(strlen($email) > 128)
        throw new DomainException("Le pseudo ne peut pas contenir plus de 128 caractères.");
        if(strlen($pseudo) > 64)
        throw new DomainException("Le pseudo ne peut pas contenir plus de 64 caractères.");
        if(strlen($userComment) > 512)
        throw new DomainException("Le commentaire dépasse la limite de 512 caractères.");

        $sql = 'INSERT INTO comments(refproduct,posteddate,email,pseudo,satisfaction,usercomment)
                VALUES (?,NOW(),?,?,?,?)';
                
        $this->db->executeSql($sql,[$refProduct,$email,$pseudo,$satisfaction,$userComment]);
        
    }

    function readCommentsJoinProducts($refproduct){
        $sql = 'SELECT products.title, comments.id, comments.refproduct, DATE_FORMAT(posteddate,"%d/%m/%Y") AS reformeddate, DATE_FORMAT(posteddate,"%H:%i") AS reformedhour, email,pseudo,satisfaction,usercomment
        FROM comments
        INNER JOIN products ON comments.refproduct = products.ref
        WHERE comments.refproduct = ? 
        ORDER BY posteddate DESC' ;

        return $this->db->query($sql,[$refproduct]);
    }

    function delete($id){
        $sql = 'DELETE FROM comments WHERE id=?';

        $this->db->executeSql($sql,[$id]);
    }
}