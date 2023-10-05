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

      $request_data = json_decode(file_get_contents('php://input'), true);

      if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $sql = "SELECT * FROM `book`";

        $result = mysqli_query($conn, $sql);

        if($result){
            $data = array();
            while($row = mysqli_fetch_assoc($result)){
                $data[] = $row;
            }

            header('Content-Type: application/json');
            echo json_encode($data);
           
        } else{
            header('Content-Type: application/json');
            $failure = "Failed to retrieve books";
            echo json_encode(['failure' => $failure]);
        }

      }

?>