<?php
  require 'vendor/autoload.php';

  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->safeLoad();
  
  require 'Model/ClientModel.php';

  Flight::route('/', function(){
    $clientsModel = new ClientModel();
    $query = 'SELECT * FROM client';
    $fields = [];
    $clientsModel->fetch($query, $fields);
  });

  Flight::start();
?>