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

	public function __construct() {
		$this->id_user = null;
		$this->id_type = null;
		$this->id_league = null;
		$this->licence_num = null;
		$this->f_name = null;
		$this->l_name = null;
		$this->birthdate = null;
		$this->mail = null;
		$this->password = null;
		$this->adress = null;
		$this->postal_code = null;
		$this->city = null;
	}

	public function create($args) {
		$args['f_name'] ? $this->f_name = $args['f_name']: false;
		$args['l_name'] ? $this->l_name = $args['l_name']: false;
	}

	public function save() {
		$bdd = new BDD();
		$bdd->insert("user", $this);
		// requete sql
	}
}