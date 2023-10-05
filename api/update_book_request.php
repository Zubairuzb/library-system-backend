<?php 
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../connection.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Check if the request is an OPTIONS preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Return an empty response for preflight requests
    http_response_code(204);
    exit();
  }

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

  $request_data = json_decode(file_get_contents('php://input'), true);
  echo json_encode($request_data);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(is_array($request_data)){
        $bookId = $request_data['bookId'];
        $userId = $request_data['userId'];
        echo $bookId;
        echo $userId;
     
        $sql = "INSERT INTO `requests` (`user_id`, `book_id`) VALUES ('$userId', '$bookId')";
     
        $result = mysqli_query($conn, $sql);
     
        if($result){
         header('Content-Type: application/json');
         echo json_encode(array("message" => "Request status updated successfully."));
        }else{
         header('Content-Type: application/json');
         echo json_encode(array("message" => "Failed to update from server"));
        }     
    }else {
        header('Content-Type: application/json');
        echo json_encode(array("message" => "Invalid request data."));
    }
  }

