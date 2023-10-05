<?php 
session_start();
require '../../connection.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Check if the request is an OPTIONS preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Return an empty response for preflight requests
    http_response_code(204);
    exit();
  }

  if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $sql = "SELECT * FROM `requests` ";

        header('Content-Type: application/json');
        $result = mysqli_query($conn, $sql);

        if ($result){    
            $response = array();
            while($row = mysqli_fetch_assoc($result)){
                $response[] = $row;
            }
            $success = "Fetch requested data";
            // $fullname = $row['fullname'];
            // $user_id = $row['user_id'];

            // $_SESSION['fullname'] = $fullname;
            // $_SESSION['user_id'] = $user_id;
            
            $responseData = array(
                'success' => $success,
                'data' => $response,
            );

            echo json_encode($responseData);

        } else{
            $failure = "Failed to fetch requested data";
            
            $responseData = array(
                'failure' => $failure,
            );
            echo json_encode($responseData);
        }

      }
?>