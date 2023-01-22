<?php
  require_once '/app/server/Model/Model.php';

  class ProductClientService {
    private $model;

    public function __construct() {
      $this->model = new Model();
    }

    public function find() {
      $query = '
        SELECT PC.product_client_id AS id, C.id AS client_id, C.company AS client, P.name AS product, P.id AS product_id, PC.expiration_date AS expirationDate FROM product_client AS PC
        JOIN products AS P
          ON PC.product_id = P.id
        JOIN clients AS C
          ON PC.client_id = C.id';
      $result = $this->model->fetch($query);
      return $result;
    }

    public function findById($id) {
      $query = '
        SELECT PC.product_client_id AS id, C.id AS client_id, C.company AS client, P.name AS product, P.id AS product_id, PC.expiration_date AS expirationDate FROM product_client AS PC
        JOIN products AS P
          ON PC.product_id = P.id
        JOIN clients AS C
          ON PC.client_id = C.id
        WHERE PC.product_client_id = :id';
      $fields = ['id' => $id];
      $result = $this->model->fetch($query, $fields);
      return $result;
    }

    public function findByClientId($id) {
      $query = '
        SELECT PC.product_client_id AS id, C.id AS client_id, C.company AS client, P.name AS product, P.id AS product_id, PC.expiration_date AS expirationDate FROM product_client AS PC
        JOIN products AS P
          ON PC.product_id = P.id
        JOIN clients AS C
          ON PC.client_id = C.id
        WHERE PC.client_id = :id';
      $fields = ['id' => $id];
      $result = $this->model->fetch($query, $fields);
      return $result;
    }

    public function insert($input) {
      $result = $this->model->insert('product_client', $input);
      return $result;
    }

    public function update($input, $id) {
      $result = $this->model->update('product_client', $input, $id, 'product_client_id');
      return $result;
    }

    public function delete($id) {
      $field = ['id' => $id];
      $result = $this->model->delete('product_client', $field, 'product_client_id');
      return $result;
    }

    public function updateExpirationDates($clientId, $daysToAdd) {
      $this->model->execute("CALL STP_ATUALIZAVALIDADE_CLIENTE(" . $clientId . ", " . $daysToAdd . ");");
      $result = $this->findByClientId($clientId);
      return $result;
    }

  }    
?>