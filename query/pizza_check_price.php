<?php

    session_start();
    include_once('../utils/condb.php');
    if(!$_SESSION['user_data']){
        echo 'Unauthorize';
        exit(0);
    }

    $final_result = array();

    if($_GET['fsid'] && $_GET['fid'] && $_GET['fcid']){

        // TODO 
        // query data food and total price

        try{
            
            $sql = "select * from food where fid = ? ";
            $stmt = $condb->prepare($sql);
            $stmt->bind_param('s',$_GET['fid']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            $target_ftid = $row['ftid'];

            array_push($final_result , $row);

            // print_r($row);
            array_push($final_result,array("size" => $_GET['fsid'],"type" => $target_ftid, "curst" => $_GET['fcid']));


            $sql = "SELECT (food_type.price + food_size.price + food_crust.price) as total
            FROM  food_crust, food_size , food_type
            where food_type.ftid = ?
            and   food_size.fsid = ?
            and   food_crust.fcid = ?";
            $stmt = $condb->prepare($sql);
            $stmt->bind_param('sss',$target_ftid,$_GET['fsid'],$_GET['fcid']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            array_push($final_result,$row);

        }catch(e){

        }




    


    }

    // $dataArray = array('b', 'c', 'd');
    echo json_encode($final_result);
?>