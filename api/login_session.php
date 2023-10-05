<?php
    session_start();
    require '../connection.php';
    
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    header('Access-Control-Allow-Origin: http://localhost:5173');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Access-Control-Allow-Credentials: true');
    
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        // Return an empty response for preflight requests
        http_response_code(204);
        exit();
      }
    
      if(isset($_SESSION['user_id'])){
        header('Content-Type: application/json');
        echo "session retrieved";
        echo json_encode(['user_id' => $_SESSION['user_id'], 'fullname' =>  $_SESSION['fullname']]);
      }else{
        header('Content-Type: application/json');
        echo json_encode(['failure' => 'failed to retrieve session']);
      }
?>