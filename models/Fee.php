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
  private $coef;

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

      $query = "SELECT id_fee, id_note, fee.id_fee_type, creation_date, fee.caption, amount, validated, coef FROM fee, fee_type WHERE fee_type.id_fee_type = fee.id_fee_type ";
      if(!is_null($id_note)) {
        $query .= " AND ID_NOTE = " . $id_note;
      }

      $bdd = new BDD();
      $bdd = $bdd->connect();
      $res = $bdd->query($query);
      $res = $res->fetchAll();

      foreach ($res as $key => $fee) {
          $fee->creation_date = date('d/m/Y', strtotime($fee->creation_date));
        	$fee->amount = $fee->amount*$fee->coef;
      }

      return $res;

  }

  public function fetch($id_fee) {
    $query = "SELECT id_fee, id_fee_type, creation_date, caption, amount FROM fee WHERE id_fee = $id_fee";
    $bdd = new BDD();
    $bdd = $bdd->connect();
    $res = $bdd->query($query)->fetch();
    $res->creation_date = date('d/m/Y', strtotime($res->creation_date));
    return $res;
  }

  public function save() {
    if (!is_null($this->id_fee)) {
      $query = "UPDATE fee SET ID_FEE_TYPE = \"".$this->id_fee_type."\", CREATION_DATE = \"".$this->date_fee."\", CAPTION = \"".$this->caption."\", AMOUNT = $this->amount WHERE ID_FEE = $this->id_fee";
      $bdd = new BDD();
      $res = $bdd->connect()->exec($query);
      if($res > 0)
        return true;
      else
        return false;
    }
    else {
      // insert
    }
  }
}

?>
