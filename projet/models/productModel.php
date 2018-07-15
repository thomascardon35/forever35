<?php

require_once '../config/databaseClass.php';

class Product{
    private $db;

    function __construct(){
        $this->db = new Database;
    }

    function create($ref,$category,$categoryForCSS,$title,$capacity,$composition,$productDescription){

        $sql = 'INSERT INTO products(ref,category,categoryforcss,title,capacity,composition,productdescription)
                VALUES (?,?,?,?,?,?,?)';
                
        $this->db->executeSql($sql,[$ref,$category,$categoryForCSS,$title,$capacity,$composition,$productDescription]);
        
    }

    function read(){
        $sql = 'SELECT id,ref,category,title,capacity,composition,productdescription
                FROM products
                ORDER BY  ref ASC';
                
        return $this->db->query($sql);
        
    }

    function readById($id){
        $sql = 'SELECT id,ref,category,categoryforcss,title,capacity,composition,productdescription
        FROM products
        WHERE id = ?' ;

        return $this->db->queryOne($sql,[$id]);
    }

    function readByRef($ref){
        $sql = 'SELECT id,ref,category,categoryforcss,title,capacity,composition,productdescription
        FROM products
        WHERE ref = ?' ;

        return $this->db->queryOne($sql,[$ref]);
    }

    function readByCategory($category){
        $sql = 'SELECT id,ref,title
        FROM products
        WHERE category = ?
        ORDER BY ref ASC' ;

        return $this->db->query($sql,[$category]);
    }

    function update($ref,$category,$categoryForCSS,$title,$capacity,$composition,$productDescription,$id){
        $sql = 'UPDATE products
                SET ref = ?,
                category = ?,
                categoryforcss = ?,
                title = ?,
                capacity = ?,
                composition = ?,
                productdescription = ?
                WHERE id = ?';


        $newsEventUpdate = $this->db->executeSql($sql,[$ref,$category,$categoryForCSS,$title,$capacity,$composition,$productDescription,$id]);
        
    }

    function delete($id){
        $sql = 'DELETE FROM products WHERE id=?';

        $this->db->executeSql($sql,[$id]);
    }

};