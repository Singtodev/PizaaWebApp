<?php

    session_start();
    include_once('../utils/condb.php');
    if(!$_SESSION['user_data']){
        echo 'Unauthorize';
        exit(0);
    }

    $message = "";
    $status = 400;


    if(isset($_GET['oid']) && isset($_GET['payment_method']) && isset($_GET['recipient_address']) && isset($_GET['recipient_phone']) && isset($_GET['recipient_name'])){
        
        // step 1
        // query sum total by oid

        $sql = "SELECT sum((food_type.price + food_crust.price + food_size.price) * order_amount.amount) as total
        FROM  order_amount,food,food_crust,food_size,food_type
        WHERE order_amount.fid = food.fid
        AND   food.ftid = food_type.ftid
        AND   order_amount.fcid = food_crust.fcid
        AND   order_amount.fsid = food_size.fsid
        AND   order_amount.oid = ?
        ";
        $stmt = $condb->prepare($sql);
        $stmt->bind_param('s', $_GET['oid']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $sum_total = $row['total'];


        // step 2

        // update billing and adding data
        // set status to waiting for delivery
        // add description
        date_default_timezone_set("Asia/Bangkok");
        $odate = date('Y-m-d H:i:s'); // get current datetime

        $sql2 = "UPDATE iorder set status = 2 ,total = ?, payment_method = ?, recipient_name = ? , recipient_phone = ? , recipient_address = ?, odate = ? where oid = ?";
        $stmt2 = $condb->prepare($sql2);
        $stmt2->bind_param('sssssss',$sum_total,$_GET['payment_method'] , $_GET['recipient_name'],$_GET['recipient_phone'],$_GET['recipient_address'], $odate, $_GET['oid']);
        $stmt2->execute();
        if($stmt2->affected_rows == 1){
            $message = "ชำระเงินเรียบร้อย";
            $status = 200; 
        }else{
            $message = "เกิดข้อผิดพลาด";
        }
    }

    $result_final = array("message"=> $message , "status"=> $status);
    echo json_encode($result_final);

?>