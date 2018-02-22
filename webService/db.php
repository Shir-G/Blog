<?php
    define('BASE_PATH', 'http://localhost:8080/blog/webService');
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blog";

    $connect = new mysqli($servername, $username, $password, $dbname);
    if($connect->connect_errno){
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit();
    }
?>