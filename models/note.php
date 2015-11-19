<?php

class Note
{
    private $id_note = null;
    private $id_note_state = null;
    private $id_user = null;
    public $year = null;

    public function __construct($args = null) {
        if($args) {
            foreach ($args as $key => $value) {
                if(property_exists("Note", $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function fetch($id) {

        $query = "SELECT * FROM note WHERE id_note = ".$id;
        $bdd = new BDD();
        $bdd = $bdd->connect();
        $req = $bdd->query($query);
        $res = $req->fetch();

        foreach ($res as $key => $value) {
            $this->$key = $value;
        }

        return $this;
    }

    public function fetchAll($id_user = null, $year = null) {

        $query = "SELECT * FROM note WHERE 1";
        if(!is_null($id_user)) {
          $query .= " AND ID_USER = " . $id_user;
        }
        if(!is_null($year)) {
          $query .= ' AND YEAR(YEAR) = "'. $year . '"';
        }

        $bdd = new BDD();
        $bdd = $bdd->connect();
        $res = $bdd->query($query);
        return $res->fetchAll();

    }

    public function getNoteFees() {
      $fee = new Fee();
      $fees = $fee->fetchAll($this->id_note);
      $this->fees = $fees;
      return $this;
    }

    public function save() {

        if(!is_null($this->id_note)) {
          //update
        } else {
          //insert
        }
    }
}
?>
