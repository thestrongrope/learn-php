<?php

  require 'connect.php';

  // Takes raw data from the request
  $data = json_decode(file_get_contents('php://input'));

  header("Access-Control-Allow-Origin: *");
  header('Content-Type: application/json');
  echo json_encode($data);