<?php
  function snakelize($string) {
    $string = preg_replace("/[A-Z]/", "_" . "$0" , $string);
    return strtolower($string);
  }

  function camelize($string) {
    $string = preg_replace("/_/", " ", $string);
    $string = ucwords($string);
    $string = explode(" ", $string);
    return lcfirst(implode($string));
  }
?>