<?php 
  require_once 'Connection.php';
  require_once '/app/server/Interfaces/AbstractModel.php';

  class ClientModel extends Connection implements AbstractModel {
    public function __construct() {
      parent::__construct();
    }

    public function fetch($query, $fields = []) { 
      $stmt = $this->conn->prepare($query);
      $stmt->execute($fields);

      $result = $stmt->fetchAll(PDO::FETCH_OBJ);

      if (count($result)) {
        return $result;
      } else {
        return [];
      }
    }
  }

?>