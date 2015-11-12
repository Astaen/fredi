<?php
/**
 * Gestion des Notes
 */
// require('/class/bdd.php');

class Note
{
    private $id_note = null;
    private $id_note_state = null;
    private $id_user = null;
    public $year = null;


    public function __construct() {

    }

    public function fetch($id) {

        $query = "SELECT * FROM note WHERE id_note = ".$id;
        $bdd = new BDD();
        $bdd = $bdd->connect();
        $res = $bdd->query($query);
        return $res->fetch();

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

    public function create($args) {

        $this->id_note_state = $args['id_note_state'];
        $this->id_user = $args['id_user'];
        $this->year = $args['year'];

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
