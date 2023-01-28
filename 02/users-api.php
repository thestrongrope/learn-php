<?php

  require 'connect.php';
  
  $page = intval($_GET['page'] ?? '1');
  $pageSize = intval($_GET['pageSize'] ?? '100');

  $search = $_GET['search'] ?? null;

  $sortBy = $_GET['sortBy'] ?? 'name';
  $sortDir = $_GET['sortDir'] ?? 'asc';
  
  $permittedSortByFields = ['name', 'email', 'city'];

  if(array_search($sortBy, $permittedSortByFields) === FALSE) $sortBy = 'name';

  if($sortDir !== 'asc') $sortDir = 'desc';

  $sql = 'SELECT SQL_CALC_FOUND_ROWS id, name, email, city FROM users ';
  $params = [];
  if($search) {
    $sql .= ' WHERE name LIKE :s1 OR city LIKE :s2 OR city LIKE :s3';
    $params = ['s1' => "%$search%", 's2' => "%$search%", 's3' => "%$search%"];
  }
  $start = (($page - 1) * $pageSize);
  $sql .= ' 
    ORDER BY '.$sortBy.' '.$sortDir.'
    LIMIT ' . $start . ', ' . $pageSize. '';

  $stmt = $pdo->prepare($sql);
  $stmt->execute($params);
  $users = $stmt->fetchAll();

  $sql = 'SELECT FOUND_ROWS() cnt';
  $stmt = $pdo->query($sql);
  $count = $stmt->fetch();

  header("Access-Control-Allow-Origin: *");
  header('Content-Type: application/json');
  echo json_encode([
    'data' => $users,
    'totalCount' => $count['cnt'],
    'totalPages' => ceil($count['cnt'] / $pageSize),
    'page' => $page,
    'pageSize' => $pageSize,
    'search' => $search,
    'sortBy' => $sortBy,
    'sortDir' => $sortDir
  ]);