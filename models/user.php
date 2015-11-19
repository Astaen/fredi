<?php

require "class/bdd.php";

class User {

	private $id_user;
	private $id_type;
	private $id_league;
	public $licence_num;
	public $f_name;
	public $l_name;
	public $birthdate;
	public $mail;
	private $password;
	public $adress;
	public $postal_code;
	public $city;

    public function __construct($args = null) {
        if($args) {
            foreach ($args as $key => $value) {
                if(property_exists("User", $key)) {
                    $this->$key = $value;
                }
            }           
        }
    }

    public function fetch($id) {

        $query = "SELECT * FROM user WHERE id_user = ".$id;
        $bdd = new BDD();
        $bdd = $bdd->connect();
        $req = $bdd->query($query);
        $res = $req->fetch();

		foreach ($res as $key => $value) {
			$this->$key = $value;
		}

		return $this;
    }

    public function fetchAll($id_type = null) {

        $query = "SELECT * FROM user WHERE 1";
        if(!is_null($id_type)) {
          $query .= " AND ID_TYPE = " . $id_type;
        }

        $bdd = new BDD();
        $bdd = $bdd->connect();
        $res = $bdd->query($query);
        return $res->fetchAll();

    }

	public function save() {

	}
}