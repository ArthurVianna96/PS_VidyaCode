<?php
  interface AbstractModel {

    public function fetch($query, $fields);
    
    public function insert($tableName, $input);
  }
?>