<?php

    session_start();


    include_once('../utils/condb.php');


    if(!$_SESSION['user_data']){
        echo 'Unauthorize';
        exit(0);
    }



    $message = "";
    $status = 400;

    // check billing 

    // case 1
    // not have cart go create this and add 
    
    $sql_check = "SELECT count(*) as count FROM iorder where uid = ? and status = ?";
    $stmt = $condb->prepare($sql_check);
    $status = '1';
    $stmt->bind_param('ss', $_SESSION['user_data']['uid'], $status);
    $stmt->execute();
    $result_billing = $stmt->get_result();
    $row_billing = $result_billing->fetch_assoc();



    if($row_billing['count'] == 0){


        // create cart item 


        $sql2 = "INSERT INTO `iorder` (`uid`, `odate`, `payment_method`, `recipient_name`, `recipient_phone`, `recipient_address`, `total`, `status`) VALUES (?, current_timestamp(), NULL, NULL, NULL, NULL, '0.00', '1');";
        $stmt2 = $condb->prepare($sql2);
        $stmt2->bind_param('s', $_SESSION['user_data']['uid']);
        $stmt2->execute();
        
        if ($stmt2->affected_rows == 1) {
            $message = 'A new order has been created.';
        }


        // query cart user

        $sql = "select * from iorder where uid = ? and status = 1 ";
        $stmt = $condb->prepare($sql);
        $stmt->bind_param('s', $_SESSION['user_data']['uid']);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $oid = $data['oid'];

        // add item to cart

        $sql = "INSERT INTO order_amount(oid, fid, fsid, fcid, amount) VALUES (?, ?, ?, ?, '1')";
        $stmt = $condb->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('ssss', $oid, $_GET['fid'], $_GET['fsid'], $_GET['fcid']);
            $stmt->execute();
            $stmt->close();
            $message = 'add item successfully!';
            $status = 200;
        } else {
            // echo "Error: " . $condb->error;  // Handle the error appropriately
        }

    }else{

        // case 2
        // user have cart go add item


        // query cart user

        $sql = "select * from iorder where uid = ? and status = 1 ";
        $stmt = $condb->prepare($sql);
        $stmt->bind_param('s', $_SESSION['user_data']['uid']);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $oid = $data['oid'];

        // add item to cart

        $sql = "INSERT INTO order_amount(oid, fid, fsid, fcid, amount) VALUES (?, ?, ?, ?, '1')";
        $stmt = $condb->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('ssss', $oid, $_GET['fid'], $_GET['fsid'], $_GET['fcid']);
            $stmt->execute();
            $stmt->close();
            $message = 'add item successfully!';
            $status = 200;
        } else {
            // echo "Error: " . $condb->error;  // Handle the error appropriately
        }


    }



    $result = array("message"=> $message , "status"=> $status);

    echo json_encode($result);

    






?>