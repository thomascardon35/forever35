<?php
class Database{
    private $pdo;

    public function __construct(){
        $dbHost='localhost';
        $dbName='id6295651_forever35';
        $dbUser='id6295651_tomcardon35';
        $dbPass='grtA4%5yN';

        $this-> pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser,$dbPass, [
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_WARNING,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET lc_time_names = 'fr_FR'",
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_zone = '+02:00'"
        ]);
    }
    

    public function executeSql($sql, array $values = array()){
		$query = $this->pdo->prepare($sql);

		$query->execute($values);

	}

    public function query($sql, array $criteria = array())
    {
        $query = $this->pdo->prepare($sql);

        $query->execute($criteria);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function queryOne($sql, array $criteria = array())
    {
        $query = $this->pdo->prepare($sql);

        $query->execute($criteria);

        return $query->fetch(PDO::FETCH_ASSOC);
    }
}