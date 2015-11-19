<?php
/**
 *
 */
class Fee
{
  private $id_fee;
  private $id_note;
  private $id_fee_type;
  private $date_fee;
  private $caption;
  private $amount;

  function __construct($args = null) {
    if($args) {
        foreach ($args as $key => $value) {
            if(property_exists("Fee", $key)) {
                $this->$key = $value;
            }
        }
    }
  }

  public function fetchAll($id_note = null) {

      $query = "SELECT * FROM fee WHERE 1";
      if(!is_null($id_note)) {
        $query .= " AND ID_NOTE = " . $id_note;
      }

      $bdd = new BDD();
      $bdd = $bdd->connect();
      $res = $bdd->query($query);
      return $res->fetchAll();
      
  }

  public function save() {
    if (!is_null($this->id_fee)) {
      // update
    }
    else {
      // insert
    }
  }
}

?>
