<?php

class Note
{
    public $id_note = null;
    public $id_note_state = null;
    public $id_user = null;
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

        $query = "SELECT `ID_NOTE`, `ID_USER`,`note`.`ID_NOTE_STATE`, `YEAR`, `LIBELLE` FROM `note`, `note_state` WHERE note.id_note_state = note_state.id_note_state AND id_note = ".$id;
        $bdd = new BDD();
        $bdd = $bdd->connect();
        $req = $bdd->query($query);
        $res = $req->fetch();

        foreach ($res as $key => $value) {
            $this->$key = $value;
        }

        //get note fees
        $this->fees = $this->getNoteFees($this->id_note);
        $this->total = 0;
        foreach ($this->fees as $fee) {
            $this->total += $fee->amount;
        }

        $this->year = date("Y", strtotime($this->year));

        return $this;
    }

    public function fetchAll($id_user = null, $year = null) {

        $query = "SELECT `ID_NOTE`, `ID_USER`,`note`.`ID_NOTE_STATE`, `YEAR`, `LIBELLE` FROM `note`, `note_state` WHERE note.id_note_state = note_state.id_note_state AND 1";
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
            $el->year = date("Y", strtotime($el->year));
            $el->fees = $this->getNoteFees($el->id_note);
            $el->total = 0;
            foreach ($el->fees as $fee) {
                $el->total += $fee->amount;
            }
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
