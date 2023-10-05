<?php 
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../connection.php';
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
    $fullname = $request_data['fullname'];
    $email = $request_data['email'];
    $password = $request_data['password'];
    $gender = $request_data['gender'];
    $level = $request_data['level'];

    $sql = "INSERT INTO `user` (`fullname`, `email`, `password`, `gender`, `level`) VALUES('$fullname', '$email', '$password', '$gender', '$level')";

        $result = mysqli_query($conn, $sql);
        if ($result){
          $success = "Registered successfully, Please Login";
          $_SESSION['success'] = $success;
          $_SESSION['email'] = $email;
          $registerSessionMessage = array(
              'success' => $_SESSION['success'],
          );
          header('Content-Type: application/json');
          echo json_encode($registerSessionMessage);

          } else{
            $failure = "Failed to register";
            $_SESSION['failure'] = $failure;
            $registerSessionMessage = array(
              'failure' => $_SESSION['failure']
          );

          header('Content-Type: application/json');
          echo json_encode($registerSessionMessage);
          }
    

    // if (!empty($fullname) && !empty($email) && !empty($password) && !empty($gender) && !empty($level)){
       
    // } else {
    //   echo "some field not empty";
    // }
  }
  
?>