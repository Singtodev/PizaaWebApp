<?php
    $host = "202.28.34.197";
    $user = "web66_65011212038";
    $pass = "65011212038@csmsu";
    $dbname = "web66_65011212038";
    $condb = mysqli_connect($host,$user,$pass,$dbname);

    if($condb->connect_error){
        die("Connect failed" . $conn->connect_error);
    }
?>