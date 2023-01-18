<?php
  require_once '/app/server/Model/ProductModel.php';

  class ProductService {
    private $productModel;

    public function __construct() {
      $this->productModel = new ProductModel();
    }

    public function find() {
      $query = 'SELECT * FROM products';
      $result = $this->productModel->fetch($query);
      return $result;
    }

    public function findById($id) {
      $query = 'SELECT * FROM products WHERE id = :id';
      $fields = ['id' => $id];
      $result = $this->productModel->fetch($query, $fields);
      return $result;
    }

    public function insert($input) {
      $result = $this->productModel->insert('products', $input);
      return $result;
    }

  }    
?>