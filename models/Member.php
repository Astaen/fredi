<?php

class Member {

	public $licence_num;
    public $id_club;
    public $sex;
	public $f_name;
	public $l_name;
	public $birthdate;
	public $adress;
	public $postal_code;
	public $city;

    public function __construct($args = null) {
        if($args) {
            foreach ($args as $key => $value) {
                if(property_exists("Member", $key)) {
                    $this->$key = $value;
                }
            }           
        }
    }

    public function fetch($id) {

        $query = "SELECT * FROM club_member WHERE licence_num = ".$id;
        var_dump($query);
        $bdd = new BDD();
        $bdd = $bdd->connect();
        $req = $bdd->query($query);
        $res = $req->fetch();

		foreach ($res as $key => $value) {
			$this->$key = $value;
		}

		return $this;

    }

    public function fetchAll() {

        $query = "SELECT * FROM club_member WHERE 1";            

        $bdd = new BDD();
        $bdd = $bdd->connect();
        $res = $bdd->query($query);
        return $res->fetchAll();

    }

	public function save() {

	}
}