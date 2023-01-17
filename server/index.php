<?php
  require 'vendor/autoload.php';

  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->safeLoad();
  
  require 'Controllers/ClientController.php';

  Flight::route('/', function(){
    $clientController = new ClientController();
    $clients = $clientController->listClients();
    Flight::json($clients, 200);
  });

  Flight::start();
?>