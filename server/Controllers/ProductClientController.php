<?php
  require_once '/app/server/Services/ProductClientService.php';
  require_once '/app/server/Utils/ErrorMap.php';

  class ProductClientController {
    private $productClientService;
    private $errorMap;
    public function __construct() {
      $this->productClientService = new ProductClientService();
      $this->errorMap = createErrorMap();
    }

    public function find() {
      $result = $this->productClientService->find();
      return $result;
    }

    public function findById($id) {
      $result = $this->productClientService->findById($id);
      if (!$result) {
        return [
          'status' => $this->errorMap['NOT_FOUND'],
          'data' => [
            'message' => 'No relationship found',
          ]
        ];
      }
      return [
        'status' => 200,
        'data' => $result[0],
      ];
    }

    public function insert($request) {
      $input = [
        'productId' => $request->productId,
        'clientId' => $request->clientId,
      ];
      try {
        $result = $this->productClientService->insert($input);
        return [
          'status' => 201,
          'data' => $input
        ];
      } catch (PDOException $e) {
        return [
          'status' => 500,
          'data' => [
            'message' => $e->getMessage(),
          ]
        ];
      }
    }
  }
?>