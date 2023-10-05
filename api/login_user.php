<?php 
session_start();

include '../connection.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Check if the request is an OPTIONS preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Return an empty response for preflight requests
    http_response_code(204);
    exit();
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_body = file_get_contents('php://input');
    $request_data = json_decode($request_body, true);

    if (is_array($request_data)) {
        $email = $request_data['email'];
        $password = $request_data['password'];

        $sql = "SELECT * FROM `user` WHERE `email` = '$email' AND `password` = '$password' ";

        header('Content-Type: application/json');
        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($result)){

            $success = "Login successfully";
            $fullname = $row['fullname'];
            $user_id = $row['user_id'];

            $_SESSION['success'] = $success;
            $_SESSION['fullname'] = $fullname;
            $_SESSION['user_id'] = $user_id;
                     
            $logiSessionData = array(
                'fullname' => $_SESSION['fullname'],
                'success' => $_SESSION['success'],
                'user_id' => $_SESSION['user_id']
            );

            echo json_encode($logiSessionData);

        } else{
            $failure = "Failed to Login, check credentials";
            $_SESSION['failure'] = $failure;
            $logiSessionData = array(
                'failure' => $_SESSION['failure']
            );
            echo json_encode($logiSessionData);
        }

      }
  }
?>