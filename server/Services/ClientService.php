<?php
  require_once '/app/server/Model/Model.php';

  class ClientService {
    private $clientModel;

    public function __construct() {
      $this->clientModel = new Model();
    }

    public function find() {
      $query = 'SELECT * FROM clients';
      $result = $this->clientModel->fetch($query);
      return $result;
    }

    public function findById($id) {
      $query = 'SELECT * FROM clients WHERE id = :id';
      $fields = ['id' => $id];
      $result = $this->clientModel->fetch($query, $fields);
      return $result;
    }

    public function insert($input) {
      $result = $this->clientModel->insert('clients', $input);
      return $result;
    }

    public function update($input, $id) {
      $result = $this->clientModel->update('clients', $input, $id, 'id');
      return $result;
    }

    public function delete($id) {
      $field = ['id' => $id];
      $result = $this->clientModel->delete('clients', $field);
      return $result;
    }
  }    
?>