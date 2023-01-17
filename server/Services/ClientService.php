<?php
  require_once '/app/server/Model/ClientModel.php';

  class ClientService {
    private $clientModel;

    public function __construct() {
      $this->clientModel = new ClientModel();
    }

    public function listClients() {
      $query = 'SELECT * FROM client';
      $result = $this->clientModel->fetch($query);
      return $result;
    }
  }
?>