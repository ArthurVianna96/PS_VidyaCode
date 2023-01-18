<?php
  require_once '/app/server/Model/ClientModel.php';

  class ClientService {
    private $clientModel;

    public function __construct() {
      $this->clientModel = new ClientModel();
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

  }    
?>