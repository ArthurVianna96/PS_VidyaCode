<?php 
  require_once 'Connection.php';

  class ClientModel extends Connection {
    public function __construct() {
      parent::__construct();
    }

    public function fetch($query, $fields) { 
      $stmt = $this->conn->prepare($query);
      $stmt->execute($fields);

      $result = $stmt->fetchAll();

      if (count($result)) {
        foreach($result as $row) {
          print_r($row);
        }
      } else {
        echo "Nennhum resultado retornado.";
      }
    }
  }

?>