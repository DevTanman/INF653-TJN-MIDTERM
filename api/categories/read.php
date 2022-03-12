<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $category = new Category($db);

  $result = $category->read();
  
  $num = $result->rowCount();

  if($num > 0) {
        $cat_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
          array_push($cat_arr, (object)['id' => $id, 'category' => $category]);
        }

        echo json_encode($cat_arr);

  } else {
        echo json_encode(
          array('message' => 'No Categories Found')
        );
  }
