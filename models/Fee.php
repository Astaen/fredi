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
  private $validated;

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
      $res = $res->fetchAll();

      foreach ($res as $key => $fee) {
        	$fee->creation_date = date('d/m/Y', strtotime($fee->creation_date));
      }

      return $res;
      
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
