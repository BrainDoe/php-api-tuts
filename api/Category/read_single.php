<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantaite category object
  $category = new Category($db);

  // Get the single category ID from the url
  $category->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $category->read_single();
  
  // Create array
  $cat_arr = array(
    'id' => $category->id,
    'category_name' => $category->category_name
  );

  // Make JSON
  print_r(json_encode($cat_arr));