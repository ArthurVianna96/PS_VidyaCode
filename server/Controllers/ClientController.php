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
            'message' => 'Nenhum cliente Encontrado',
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
        'company' => $request->company,
        'fictionalName' => $request->fictionalName,
        'registerNumber' => $request->registerNumber,
        'zipCode' => $request->zipCode,
        'address' => $request->address,
        'number' => $request->number,
        'district' => $request->district,
        'city' => $request->city,
        'state' => $request->state,
        'email' => $request->email,
        'phone' => $request->phone
      ];
      try {
        $result = $this->clientService->insert($input);
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
        'company' => $request->company,
        'fictionalName' => $request->fictionalName,
        'registerNumber' => $request->registerNumber,
        'zipCode' => $request->zipCode,
        'address' => $request->address,
        'number' => $request->number,
        'district' => $request->district,
        'city' => $request->city,
        'state' => $request->state,
        'email' => $request->email,
        'phone' => $request->phone
      ];
      try {
        $doesClientExist = $this->findById($id);
        if ($doesClientExist['status'] === 404) {
          return $doesClientExist;
        }
        $result = $this->clientService->update($input, $id);
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
        $doesProductClientExist = $this->findById($id);
        if ($doesProductClientExist['status'] === 404) {
          return $doesProductClientExist;
        }
        $result = $this->clientService->delete($id);
        return [
          'status' => 200,
          'data' => null
        ];
      } catch (PDOException $e) {
        if (str_contains($e->getMessage(), 'SQLSTATE[23000]')) {
          return [
            'status' => $this->errorMap['CONFLICT'],
            'data' => [
              'message' => 'O cliente está vinculado a uma compra e por isso não pode ser excluído',
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