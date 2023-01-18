<?php
  require 'vendor/autoload.php';

  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->safeLoad();
  
  require 'Controllers/ClientController.php';

  Flight::route('GET /client', function(){
    $clientController = new ClientController();
    $clients = $clientController->find();
    Flight::json($clients, 200);
  });

  Flight::route('GET /client/@id', function($id){
    $clientController = new ClientController();
    $response = $clientController->findById($id);
    Flight::json($response['data'], $response['status']); 
  });

  Flight::route('POST /client', function() {
    $clientController = new ClientController();
    $response = $clientController->insert(Flight::request()->data);
    echo $response;
  });

  Flight::start();
?>