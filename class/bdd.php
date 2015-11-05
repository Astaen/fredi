<?php

class BDD {

	private $connection;

	public function __construct() {
		try {
			$bdd = new PDO('mysql:host=localhost;dbname=fredi', 'root', 'root');
		} catch (Exception $e) {
			die('Erreur : ' . $e->getMessage());
		}
		$bdd->query('SET NAMES utf8');
		$this->connection = $bdd;
	}

	public function insert($tablename, $obj) {

		//transformer l'objet en Array
		$objArray = get_object_vars($obj);
		//retirer les valeurs nulles du tableau (et leur clé, du coup)
		$objArray = array_filter($objArray);

		//on récupère les clés du tableau pour en faire une string
		$fields = implode(", ", array_keys($objArray));
		//on récupère les valeurs du tableau dans une string
		$values = implode('", "', $objArray);

		$query = 'INSERT INTO '.$tablename.'('.$fields.') VALUES("'. $values . '")';
		$res = $this->connection->exec($query);
		return $res;
	}

	public function lastInsertId() {
		return $this->connection->lastInsertId();
	}
}

?>