<?php
  require 'vendor/autoload.php';

  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->safeLoad();
  
  require 'Controllers/ClientController.php';

  Flight::route('/client', function(){
    $clientController = new ClientController();
    $clients = $clientController->find();
    Flight::json($clients, 200);
  });

  Flight::route('/client/@id', function($id){
    $clientController = new ClientController();
    $response = $clientController->findById($id);
    Flight::json($response['data'], $response['status']); 
  });

  Flight::start();
?>