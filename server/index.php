<?php
  require 'vendor/autoload.php';

  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->safeLoad();
  
  require 'Controllers/ClientController.php';
  require 'Controllers/ProductController.php';
  require 'Controllers/ProductClientController.php';

  header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
  header("Access-Control-Allow-Headers: X-Requested-With");
  
  Flight::route('OPTIONS /*/@id', function($id) {
    Flight::json(json_encode(['status' => 'ok']), 200);
  });

  Flight::route('GET /client', function(){
    $clientController = new ClientController();
    $response = $clientController->find();
    Flight::json($response, 200);
  });

  Flight::route('GET /client/@id', function($id){
    $clientController = new ClientController();
    $response = $clientController->findById($id);
    Flight::json($response['data'], $response['status']); 
  });

  Flight::route('POST|OPTIONS /client', function() {
    $clientController = new ClientController();
    $response = $clientController->insert(json_decode(Flight::request()->getBody()));
    Flight::json($response['data'], $response['status']);
  });

  Flight::route('PUT /client/@id', function($id) {
    $clientController = new ClientController();
    $response = $clientController->update(json_decode(Flight::request()->getBody()), $id);
    Flight::json($response['data'], $response['status']);
  });

  Flight::route('DELETE /client/@id', function($id) {
    $clientController = new ClientController();
    $response = $clientController->delete($id);
    Flight::json($response['data'], $response['status']);
  });

  Flight::route('GET /product', function() {
    $productController = new ProductController();
    $response = $productController->find();
    Flight::json($response, 200);
  });

  Flight::route('GET /product/@id', function($id) {
    $productController = new ProductController();
    $response = $productController->findById($id);
    Flight::json($response['data'], $response['status']);
  });


  Flight::route('PUT /product/@id', function($id) {
    $productController = new ProductController();
    $response = $productController->update(json_decode(Flight::request()->getBody()), $id);
    Flight::json($response['data'], $response['status']);
  });

  Flight::route('POST|OPTIONS /product', function() {
    $productController = new ProductController();
    $response = $productController->insert(json_decode(Flight::request()->getBody()));
    Flight::json($response['data'], $response['status']);
  });

  Flight::route('DELETE /product/@id', function($id) {
    $productController = new ProductController();
    $response = $productController->delete($id);
    Flight::json($response['data'], $response['status']);
  });

  Flight::route('GET /purchase', function() {
    $productClientController = new ProductClientController();
    $response = $productClientController->find();
    Flight::json($response, 200);
  });

  Flight::route('GET /purchase/@id', function($id) {
    $productClientController = new ProductClientController();
    $response = $productClientController->findById($id);
    Flight::json($response['data'], $response['status']);
  });

  Flight::route('PUT /purchase/@id', function($id) {
    $productClientController = new ProductClientController();
    $response = $productClientController->update(json_decode(Flight::request()->getBody()), $id);
    Flight::json($response['data'], $response['status']);
  });

  Flight::route('DELETE /purchase/@id', function($id) {
    $productClientController = new ProductClientController();
    $response = $productClientController->delete($id);
    Flight::json($response['data'], $response['status']);
  });

  Flight::route('POST|OPTIONS /purchase', function() {
    $productClientController = new ProductClientController();
    $response = $productClientController->insert(json_decode(Flight::request()->getBody()));
    Flight::json($response['data'], $response['status']);
  });

  Flight::route('POST|OPTIONS /expiration', function() {
    $productClientController = new ProductClientController();
    $response = $productClientController->updateExpirationDates(json_decode(Flight::request()->getBody()));
    Flight::json($response['data'], $response['status']);
  });

  Flight::start();
?>