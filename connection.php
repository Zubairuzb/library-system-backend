<?php
    $servername = "localhost";
    $username = "root";
    $password_db = "";
    $dbname = "library_system";


    $conn = mysqli_connect($servername, $username, $password_db, $dbname);


    if(!$conn){
        die("connection failed: " . mysqli_connect_error());
    }
?>