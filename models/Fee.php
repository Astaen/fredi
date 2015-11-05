<?php
/**
 *
 */
class Fee
{
  private id_fee;
  private id_note;
  private id_fee_type;
  private date_fee;
  private caption;
  private amount;

  function __construct(argument)
  {
    # code...
  }

  public function get($id_fee = null) {
    $query = "SELECT * FROM FEE WHERE 1";
    if(!is_null($id_fee)) {
      $query .= " AND ID_FEE = " . $id_fee;
    }
    // faire requete
  }

  public function create($args) {
    $this->id_fee       = $args['id_fee'];
    $this->id_note      = $args['id_note'];
    $this->id_fee_type  = $args['id_fee_type'];
    $this->date_fee     = $args['date_fee'];
    $this->caption      = $args['caption'];
    $this->amount       = $args['amount'];
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
