<?php

    session_start();
    include_once('../utils/condb.php');
    if(!$_SESSION['user_data']){
        echo 'Unauthorize';
        exit(0);
    }

    $message = "";
    $status = 400;

    if(isset($_GET['odid']) && isset($_GET['method'])){


        // TODO CHECK 
        // query check quantity

        $sql = "select amount from order_amount where odid = ?";
        $stmt = $condb->prepare($sql);
        $stmt->bind_param('s',$_GET['odid']);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){

            $row = $result->fetch_assoc();

            //case 0 update size

            if($_GET['method'] == 'update_size'){

                if(isset($_GET['size'])){

                    if($row['amount'] > 0){
                        $sql_update = "update order_amount set fsid = ? where odid = ? ";
                        $stmt_update = $condb->prepare($sql_update);
                        $stmt_update->bind_param('ss' , $_GET['size'] , $_GET['odid']);
                        $stmt_update->execute();
    
                        if ($stmt_update->affected_rows == 1) {
                            $message = 'เปลี่ยนขนาดสำเร็จ!';
                            $status = 200;
                        }
    
                    }
                }

            }

            //case 1 update crust

            if($_GET['method'] == 'update_crust'){

                if(isset($_GET['crust'])){

                    if($row['amount'] > 0){
                        $sql_update = "update order_amount set fcid = ? where odid = ? ";
                        $stmt_update = $condb->prepare($sql_update);
                        $stmt_update->bind_param('ss' , $_GET['crust'] , $_GET['odid']);
                        $stmt_update->execute();
    
                        if ($stmt_update->affected_rows == 1) {
                            $message = 'เปลี่ยนขอบสำเร็จ!';
                            $status = 200;
                        }
    
                    }
                }

            }



            // case  2 increase
            if($_GET['method'] == 'increase'){

                if($row['amount'] > 0){
                    $sql_update = "update order_amount set amount = amount + 1 where odid = ? ";
                    $stmt_update = $condb->prepare($sql_update);
                    $stmt_update->bind_param('s',$_GET['odid']);
                    $stmt_update->execute();

                    if ($stmt_update->affected_rows == 1) {
                        $message = 'เพิ่มจำนวนสำเร็จ!';
                        $status = 200;
                    }
                }
            }


            //case 3 decrease item
            if($_GET['method'] == 'decrease'){

                if($row['amount'] > 1){
                    $sql_update = "update order_amount set amount = amount - 1 where odid = ? ";
                    $stmt_update = $condb->prepare($sql_update);
                    $stmt_update->bind_param('s',$_GET['odid']);
                    $stmt_update->execute();

                    if ($stmt_update->affected_rows == 1) {
                        $message = 'ลดจำนวนสำเร็จ!';
                        $status = 200;
                    }

                }else{

                    $message = 'ไม่สามารถลดจำนวนได้หรือคุณต้องการลบสินค้า?';
                    $status = 401;
                }
            }



    
        }
        


        
    }

    $result_final = array("message"=> $message , "status"=> $status);
    echo json_encode($result_final);
?>