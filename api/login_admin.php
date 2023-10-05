<?php 
session_start();
require '../connection.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Return an empty response for preflight requests
    http_response_code(204);
    exit();
  }

  $request_data = json_decode(file_get_contents('php://input'), true);

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(is_array($request_data)){
        $username = $request_data['username'];
        $password = $request_data['password'];

        $sql = "SELECT * FROM `admin` WHERE `username` = '$username' AND `password` = '$password' ";
        $result = mysqli_query($conn, $sql);

        if($row = mysqli_fetch_assoc($result)){
            header('Content-Type: application/json');
            $success = "Login Successfully";
            $_SESSION['success'] = $success;
            $_SESSION['username'] = $username;
            //Insert the success data into an array and convert to json ;
            echo json_encode(['success' => $_SESSION['success'], 'username' => $_SESSION['username']]);
        }else{
            header('Content-Type: application/json');
            $failure = "Failed to login, check credentials";
            $_SESSION['failure'] = $failure;

            echo json_encode(['failure' => $_SESSION['failure']]);
        }
    }

  }


?>