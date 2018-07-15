<?php

require_once '../config/databaseClass.php';

class loginAdmin{
    private $db;

    function __construct(){
        $this->db = new Database;
    }

    public function login($pseudo, $passwordadmin) {
        $sql =  'SELECT id, pseudo, passwordadmin 
                FROM websiteadmin 
                WHERE pseudo = ? ';

        $websiteadmin = $this->db->queryOne($sql, [$pseudo]);

        $is_password_correct = $this->verifyPassword($passwordadmin, $websiteadmin['passwordadmin']);
        
        if ($is_password_correct == false) {
            throw new DomainException('Mauvais Pseudo / Mot de passe');
        }

        return $websiteadmin;
    }

    private function verifyPassword($passwordadmin, $hashedPassword) {
        // Si le mot de passe en clair est le même que la version hachée alors renvoie true.

        return crypt($passwordadmin, $hashedPassword) == $hashedPassword;
    }

    public function update($newPseudo, $newPassword, $id){
        $hashedNewPassword = $this->hashPassword($newPassword);

        $sql = 'UPDATE  websiteadmin
                SET     pseudo = ?,
                        passwordadmin = ?
                WHERE   id = ?';

        $this->db->executeSql($sql,[$newPseudo, $hashedNewPassword, $id]);

        return true;
    }

    private function hashPassword($password) {
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
}