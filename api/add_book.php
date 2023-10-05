<?php 
require '../connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Check if the request is an OPTIONS preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Return an empty response for preflight requests
    http_response_code(204);
    exit();
  }

  
  $request_data = json_decode(file_get_contents('php://input'), true);
  

  if (is_array($request_data)) {
    $title = $request_data['title'];
    $author = $request_data['author'];
    $isbn = $request_data['isbn'];
    $year = $request_data['year'];

    $sql = "INSERT INTO `book` (`title`, `author`, `isbn`, `year`) VALUES('$title', '$author', '$isbn', '$year')";

        $result = mysqli_query($conn, $sql);
        if ($result){
          $success = "Book Added Successfully";
          $_SESSION['success'] = $success;
          $registerSessionMessage = array(
              'success' => $_SESSION['success'],
          );
          header('Content-Type: application/json');
          echo json_encode($registerSessionMessage);

          } else{
            $failure = "Failed to Add Book";
            $_SESSION['failure'] = $failure;
            $registerSessionMessage = array(
              'failure' => $_SESSION['failure']
          );

          header('Content-Type: application/json');
          echo json_encode($registerSessionMessage);
          }
  }
?>