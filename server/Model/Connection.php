<?php
  class Connection {
    protected $conn;

    public function __construct() {
      try {
        $connection = new PDO($_ENV['MYSQL_URL'], $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD']);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->conn = $connection;
      } catch (PDOException $e){
        echo 'Error: ' . $e->getMessage();
      }
    }

  }
