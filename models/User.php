<?php

class User {

	public $id_user;
	public $id_type;
	public $licence_num;
	public $mail;
	public $password;

    public function __construct($args = null) {
        if($args) {
            foreach ($args as $key => $value) {
                if(property_exists("User", $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function fetch($id = null) {

        if(is_null($id)) {
            $id = $this->id_user;
        }

        $query = "SELECT * FROM user WHERE id_user = ".$id;
        $bdd = new BDD();
        $bdd = $bdd->connect();
        $req = $bdd->query($query);
        $res = $req->fetch();

		foreach ($res as $key => $value) {
			$this->$key = $value;
		}

        $member = new Member();
        $this->details = $member->fetch($res->licence_num);

		return $this;

    }

    public function exists($email, $password = null, $isCookie = false) {
			if(!is_null($password) && !$isCookie) {
				$password = hash("sha256", $password);
			}
			if($isCookie) {
				$email = base64_decode($email);
			}
      $user = $this->fetchAll(null, $email, $password);
    	if($user) {
    		return $user[0]->id_user;
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
          $query .= " AND MAIL = '$email'";
        }
        if(!is_null($password)) {
          $query .= " AND PASSWORD = '$password'";;
        }

        // var_dump($query);

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
		$db = new BDD();
		$this->password = hash("sha256", $this->password);
		$res = $db->insert('User', $this);
        return $res;
	}
}
