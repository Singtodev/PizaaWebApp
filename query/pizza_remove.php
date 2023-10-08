<?php

    session_start();
    include_once('../utils/condb.php');
    if(!$_SESSION['user_data']){
        echo 'Unauthorize';
        exit(0);
    }
    
    $message = "";
    $status = 400;

    if(isset($_GET['odid'])){

        $sql = "DELETE FROM order_amount WHERE odid = ?";
        $stmt = $condb->prepare($sql);
        $stmt->bind_param('s' , $_GET['odid']);
        $stmt->execute();

        if ($stmt->affected_rows == 1) {
            $message = 'A Item has been deleted.';
            $status = 200;
        }



    }

    $result = array("message"=> $message , "status"=> $status);


    echo json_encode($result);





?>