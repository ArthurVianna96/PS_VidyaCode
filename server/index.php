<?php
  require 'vendor/autoload.php';

  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->safeLoad();
  
  require 'Controllers/ClientController.php';
  require 'Controllers/ProductController.php';
  require 'Controllers/ProductClientController.php';

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

  Flight::route('POST /client', function() {
    $clientController = new ClientController();
    $response = $clientController->insert(Flight::request()->data);
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

  Flight::route('POST /product', function() {
    $productController = new ProductController();
    $response = $productController->insert(Flight::request()->data);
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

  Flight::route('POST /purchase', function() {
    $productClientController = new ProductClientController();
    $response = $productClientController->insert(Flight::request()->data);
    Flight::json($response['data'], $response['status']);
  });

  Flight::route('POST /expiration', function() {
    $productClientController = new ProductClientController();
    $response = $productClientController->updateExpirationDates(Flight::request()->data);
    Flight::json($response['data'], $response['status']);
  });

  Flight::start();
?>