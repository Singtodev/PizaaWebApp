<?php
    $host = "localhost";
    $user = "demo";
    $pass = "abc123";
    $dbname = "pizza_final";
    $condb = mysqli_connect($host,$user,$pass,$dbname);

    if($condb->connect_error){
        die("Connect failed" . $conn->connect_error);
    }
?>