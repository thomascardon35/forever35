<?php

require_once 'config/databaseClass.php';

$db = new Database;

function hashPassword($password) {
    /*
    Génération du sel, nécessite l'extension PHP OpenSSL pour fonctionner.
    
    openssl_random_pseudo_bytes() va renvoyer n'importe quel type de caractères.
    Or le chiffrement en blowfish nécessite un sel avec uniquement les caractères
    a-z, A-Z ou 0-9.
     
    On utilise donc bin2hex() pour convertir en une chaîne hexadécimale le résultat,
    qu'on tronque ensuite à 22 caractères pour être sûr d'obtenir la taille
    nécessaire pour construire le sel du chiffrement en blowfish.
     */
    $salt = '$2y$11$' . substr(bin2hex(openssl_random_pseudo_bytes(32)), 0, 22);

    return crypt($password, $salt);
}


if(array_key_exists('create_password', $_POST)){
    $pseudo         = trim($_POST['pseudo']);
    $passwordadmin  = trim($_POST['passwordadmin']);

    var_dump($pseudo);
    $passwordadmin = hashPassword($passwordadmin);

    $sql = 'INSERT INTO websiteadmin(pseudo,passwordadmin)
    VALUES (?,?)';
    
    $db->executeSql($sql,[$pseudo,$passwordadmin]);

}

$template="view/create_password";
include "view/layout.phtml";