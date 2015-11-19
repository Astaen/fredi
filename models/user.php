<?php

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

    public function exists($email, $password) {
    	if($this->fetchAll(null, $email, hash("sha256", $password)) ) {
    		return true;
    	} else {
    		return false;
    	}
    }

    public function fetchAll($id_type = null, $email = null, $password = null) {

        $query = "SELECT * FROM user WHERE 1";
        if(!is_null($id_type)) {
          $query .= " AND ID_TYPE = " . $id_type;
        }
        if(!is_null($email)) {
          $query .= " AND MAIL = " . $email;
        }
        if(!is_null($password)) {
          $query .= " AND PASSWORD = " . $password;
        }                

        var_dump($query);

        $bdd = new BDD();
        $bdd = $bdd->connect();
        $res = $bdd->query($query);
        if($res) {
        	return $res->fetchAll();
        } else {
        	return false;
        }

    }

	public function save() {

	}
}