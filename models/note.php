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

        $this->fees = getNoteFees();
        
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
        $res = $res->fetchAll();

        //get note fees
        foreach ($res as $el) {
            $el->fees = $this->getNoteFees($el->id_note);
        }

        return $res;

    }

    public function getNoteFees($id = null) {
        if(is_null($id)) {
            $id = $this->id_note;
        }
        $fee = new Fee();
        $fees = $fee->fetchAll($id);
        return $fees;
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
