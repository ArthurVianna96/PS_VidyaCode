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
        'expirationDate' => $request->expirationDate,
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

    public function update($request, $id) {
      $input = [
        'productId' => $request->productId,
        'clientId' => $request->clientId,
        'expirationDate' => $request->expirationDate,
      ];
      try {
        $result = $this->productClientService->update($input, $id);
        return [
          'status' => 200,
          'data' => $result
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

    public function delete($id) {
      try {
        $result = $this->productClientService->delete($id);
        return [
          'status' => 200,
          'data' => null
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

    public function updateExpirationDates($request) {
      $clientId = $request->clientId;
      $daysToAdd = $request->daysToAdd;
      try {
        $doesHaveProducts = $this->productClientService->findByClientId($clientId);
        if(!$doesHaveProducts) {
          return [
            'status' => $this->errorMap['NOT_FOUND'],
            'data' => [
              'message' => 'Client does not have any products registered',
            ]
          ];
        }
        $result = $this->productClientService->updateExpirationDates($clientId, $daysToAdd);
        return [
          'status' => 200,
          'data' => $result
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