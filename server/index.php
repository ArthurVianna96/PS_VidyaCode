<?php
  require 'vendor/autoload.php';

  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->safeLoad();
  
  require 'Controllers/ClientController.php';
  require 'Controllers/ProductController.php';

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

  Flight::start();
?>