<?php 
  require_once 'Connection.php';
  require_once '/app/server/Utils/stringConvertion.php';

  class Model extends Connection {
    public function __construct() {
      parent::__construct();
    }

    public function fetch($query, $fields = []) { 
      $stmt = $this->conn->prepare($query);
      $stmt->execute($fields);

      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (count($result)) {
        return $result;
      } else {
        return [];
      }
    }

    public function execute($query) {
      $stmt = $this->conn->exec($query);
    }

    public function insert($tableName, $input) {
      $keys = [];
      $values = [];
      $placeholders = [];
      foreach($input as $key => $value) {
        $keys[] = snakelize($key);
        $placeholders[] = ':' . snakelize($key);
        $values[snakelize($key)] = $value;
      } 
      $query = "INSERT INTO " . $tableName . " (" . implode(', ', $keys) . ") VALUES (" . implode(', ', $placeholders) . ");";
      $stmt = $this->conn->prepare($query);
      $stmt->execute($values);
      return $query;
    }

    public function update($tableName, $input, $idValue, $idField) {
      $values = [];
      $placeholders = [];
      foreach($input as $key => $value) {
        $placeholders[] = snakelize($key) . '=:' . $key;
        $values[$key] = $value;
      }
      $values['id'] = $idValue; 
      $query = "UPDATE " . $tableName . " SET " . implode(', ', $placeholders)  . " WHERE " . $idField . "=:id;";
      $stmt = $this->conn->prepare($query);
      $stmt->execute($values);
      return $query;
    }

    public function delete($tableName, $field) {
      $query = "DELETE FROM " . $tableName . " WHERE id = :id";
      $stmt = $this->conn->prepare($query);
      $stmt->execute($field);
      return $query;
    }
  }

?>