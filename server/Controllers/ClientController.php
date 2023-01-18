<?php
  require_once '/app/server/Services/ClientService.php';
  require_once '/app/server/Utils/ErrorMap.php';

  class ClientController {
    private $clientService;
    private $errorMap;
    public function __construct() {
      $this->clientService = new ClientService();
      $this->errorMap = createErrorMap();
    }

    public function find() {
      $result = $this->clientService->find();
      return $result;
    }

    public function findById($id) {
      $result = $this->clientService->findById($id);
      if (!$result) {
        return [
          'status' => $this->errorMap['NOT_FOUND'],
          'data' => [
            'message' => 'No client found',
          ]
        ];
      }
      return [
        'status' => 200,
        'data' => $result[0],
      ];
    }
  }
?>