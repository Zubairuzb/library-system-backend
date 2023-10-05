<?php
      require '../../connection.php';
      session_start();
  
      header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
      header('Access-Control-Allow-Headers: Content-Type');
  
      if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
          // Return an empty response for preflight requests
          http_response_code(204);
          exit();
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           session_destroy();
           session_unset();
           
            if(session_status() === PHP_SESSION_NONE){
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Logout successfully']);
            }else {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Logout failed']);
            }

        }  
?>