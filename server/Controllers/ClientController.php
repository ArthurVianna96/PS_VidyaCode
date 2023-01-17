<?php
  require_once '/app/server/Services/ClientService.php';

  class ClientController {
    private $clientService;
    public function __construct() {
      $this->clientService = new ClientService();
    }

    public function listClients() {
      $result = $this->clientService->listClients();
      return $result;
    }
  }
?>