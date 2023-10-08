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


    // step 1 check user have cart item status == 1 ?

    if($row_billing['count'] == 0){

        // don't have cart

        // go step 1 create cart item 
        $sql2 = "INSERT INTO `iorder` (`uid`, `odate`, `payment_method`, `recipient_name`, `recipient_phone`, `recipient_address`, `total`, `status`) VALUES (?, current_timestamp(), NULL, NULL, NULL, NULL, '0.00', '1');";
        $stmt2 = $condb->prepare($sql2);
        $stmt2->bind_param('s', $_SESSION['user_data']['uid']);
        $stmt2->execute();

            // if success
            
            if ($stmt2->affected_rows == 1) {
                $message = 'A new order has been created.';
            }

        // go pass 


        // go step 2 find cart id by current user

        // query cart user
        $sql = "select * from iorder where uid = ? and status = 1 ";
        $stmt = $condb->prepare($sql);
        $stmt->bind_param('s', $_SESSION['user_data']['uid']);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $oid = $data['oid'];

        // received cart id => oid  // billing id



        // go step 3 add first item to cart


        // add item to cart quantity default is 1

        $sql = "INSERT INTO order_amount(oid, fid, fsid, fcid, amount) VALUES (?, ?, ?, ?, '1')";
        $stmt = $condb->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('ssss', $oid, $_GET['fid'], $_GET['fsid'], $_GET['fcid']);
            $stmt->execute();
            $stmt->close();
            $message = 'คุณเพิ่มสินค้าลงตระกร้าเรียบร้อย!';
            $status = 200;
        } else {
            // echo "Error: " . $condb->error;  // Handle the error appropriately
        }

    }else{

        // case 2
        // user already have cart item .  go adding item to cart

        // step 1 find cart id by current user
        // query cart user
        $sql = "select * from iorder where uid = ? and status = 1 ";
        $stmt = $condb->prepare($sql);
        $stmt->bind_param('s', $_SESSION['user_data']['uid']);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $oid = $data['oid'];

        // received cart id => oid  // billing id



        //step 2 find duplicate item if have go adding quantity plus 1

        $sql_3 = "select *
                from order_amount 
                where oid  = ? 
                and   fid  = ?
                and   fsid = ?
                and   fcid = ?
               ";

        $stmt_3 = $condb->prepare($sql_3);
        $stmt_3->bind_param('ssss', $oid, $_GET['fid'], $_GET['fsid'], $_GET['fcid']);
        $stmt_3->execute();
        $result_3 = $stmt_3->get_result();

        if($result_3->num_rows > 0){

            // find odid
            $row_record = $result_3->fetch_assoc();
            $odid = $row_record['odid'];

            // // if have item in cart quantity plus 1
            $sql_update = "update order_amount set amount = amount + 1 where odid = ? ";
            $sql_update = $condb->prepare($sql_update);
            $sql_update->bind_param('i', $odid);
            $sql_update->execute();
            $message = 'เพิ่มจำนวนในตระกร้าเรียบร้อย!';
            $status = 200;
            
        }else{


            // step 3 go adding item quantity default is 1
            // create new item
            // add item to cart
            $sql = "INSERT INTO order_amount(oid, fid, fsid, fcid, amount) VALUES (?, ?, ?, ?, '1')";
            $stmt = $condb->prepare($sql);
            if ($stmt) {
                $stmt->bind_param('ssss', $oid, $_GET['fid'], $_GET['fsid'], $_GET['fcid']);
                $stmt->execute();
                $stmt->close();
                $message = 'คุณเพิ่มสินค้าลงตระกร้าเรียบร้อย!';
                $status = 200;
            } else {
                // echo "Error: " . $condb->error;  // Handle the error appropriately
            }

        }
    }



    $result = array("message"=> $message , "status"=> $status);

    echo json_encode($result);

    






?>