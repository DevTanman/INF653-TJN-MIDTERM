<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    }

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    $database = new Database();
    $db = $database->connect();

    $category = new Category($db);

    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) {
    case 'PUT':
        require 'update.php';  
        break;
    case 'POST':
        require 'create.php'; 
        break;
    case 'DELETE':
        require 'delete.php'; 
        break;
    case 'GET':
        // Get ID
        if(isset($_GET['id'])) {
            require 'read_single.php';
        }
        else{
            require 'read.php';
        }
        break;
    default:
        echo 'ERROR';
        break;
    }