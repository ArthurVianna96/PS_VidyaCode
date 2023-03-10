<?php
  require_once '/app/server/Services/ProductService.php';
  require_once '/app/server/Utils/ErrorMap.php';

  class ProductController {
    private $productService;
    private $errorMap;
    public function __construct() {
      $this->productService = new ProductService();
      $this->errorMap = createErrorMap();
    }

    public function find() {
      $result = $this->productService->find();
      return $result;
    }

    public function findById($id) {
      $result = $this->productService->findById($id);
      if (!$result) {
        return [
          'status' => $this->errorMap['NOT_FOUND'],
          'data' => [
            'message' => 'Nenhum produto encontrado',
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
        'name' => $request->name,
        'description' => $request->description,
        'version' => $request->version,
      ];
      try {
        $result = $this->productService->insert($input);
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

    public function update($request,$id) {
      $input = [
        'name' => $request->name,
        'description' => $request->description,
        'version' => $request->version,
      ];
      try {
        $doesProductExist = $this->findById($id);
        if ($doesProductExist['status'] === 404) {
          return $doesProductExist;
        }
        $result = $this->productService->update($input, $id);
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

    public function delete($id) {
      try {
        $doesProductExist = $this->findById($id);
        if ($doesProductExist['status'] === 404) {
          return $doesProductExist;
        }
        $result = $this->productService->delete($id);
        return [
          'status' => 200,
          'data' => null
        ];
      } catch (PDOException $e) {
        if (str_contains($e->getMessage(), 'SQLSTATE[45000]')) {
          return [
            'status' => $this->errorMap['CONFLICT'],
            'data' => [
              'message' => 'O produto est?? vinculado a uma compra e por isso n??o pode ser exclu??do',
            ]
          ];
        }
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