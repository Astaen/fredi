<?php
/**
 *
 */
class Fee
{
  public $id_fee;
  public $id_note;
  public $id_fee_type;
  public $creation_date;
  public $caption;
  public $amount;
  public $validated;
  public $coef;

  function __construct($args = null) {
    if($args) {
        foreach ($args as $key => $value) {
            if(property_exists("Fee", $key)) {
                $this->$key = $value;
            }
        }
    }
  }

  public function fetch($id_fee = null) {
    if(!$id_fee) {
      $id_fee = $this->id_fee;
    }
    $query = "SELECT id_fee, id_note, id_fee_type, creation_date, caption, amount FROM fee WHERE id_fee = $id_fee";
    $bdd = new BDD();
    $bdd = $bdd->connect();
    $req = $bdd->query($query);
    $res = $req->fetch();

    $res->creation_date = date('d/m/Y', strtotime($res->creation_date));
    foreach ($res as $key => $value) {
        $this->$key = $value;
    }
    return $this;
  }
  
  public function fetchAll($id_note = null) {

      $query = "SELECT id_fee, id_note, fee.id_fee_type, creation_date, fee.caption, amount, validated, coef FROM fee, fee_type WHERE fee_type.id_fee_type = fee.id_fee_type ";
      if(!is_null($id_note)) {
        $query .= " AND id_note = " . $id_note;
      }
      $query .= " ORDER BY creation_date DESC";

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


  public function save() {
    if (!is_null($this->id_fee)) {
      $query = "UPDATE fee SET ID_FEE_TYPE = \"".$this->id_fee_type."\", CREATION_DATE = \"".$this->creation_date."\", CAPTION = \"".$this->caption."\", AMOUNT = $this->amount WHERE ID_FEE = $this->id_fee";
      $bdd = new BDD();
      $bdd = $bdd->connect();
      $res = $bdd->exec($query);
      return true;
    }
    else {
      $query = "INSERT INTO `fee`(`ID_FEE`, `ID_NOTE`, `ID_FEE_TYPE`, `CREATION_DATE`, `CAPTION`, `AMOUNT`, `validated`) VALUES (null,'$this->id_note','$this->id_fee_type','$this->creation_date','$this->caption','$this->amount',0)";
      var_dump($query);
      $bdd = new BDD();
      $bdd = $bdd->connect();
      $res = $bdd->query($query);
      return $res;
    }
  }
}

?>
