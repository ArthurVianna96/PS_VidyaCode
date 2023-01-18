<?php
  require_once '/app/server/Model/ClientModel.php';

  class ClientService {
    private $clientModel;

    public function __construct() {
      $this->clientModel = new ClientModel();
    }

    public function find() {
      $query = 'SELECT * FROM client';
      $result = $this->clientModel->fetch($query);
      return $result;
    }

    public function findById($id) {
      $query = 'SELECT * FROM client WHERE id = :id';
      $fields = ['id' => $id];
      $result = $this->clientModel->fetch($query, $fields);
      return $result;
    }

  }    
?>