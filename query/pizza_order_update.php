<?php
    session_start();
    include_once('../utils/condb.php');
    if(!$_SESSION['user_data']){
        echo 'Unauthorize';
        exit(0);
    }


    $result = array(
        "message" => "มีปัญหาบางอย่าง",
        "status" => 400
    );

    if(!isset($_GET['status']) || !isset($_GET['oid'])){
        $result = array(
            "message" => "ข้อมูลไม่ครบ",
            "status" => 400
        );
    }


    $sql = "UPDATE iorder set status = ? where oid = ?";
    $stmt = $condb->prepare($sql);
    $stmt->bind_param('ss',$_GET['status'],$_GET['oid']);


    if($stmt->execute()){
        $result = array(
            "message" => "ยืนยันรายการสำเร็จ",
            "status" => 200
        );
    }
    
    echo json_encode($result);
?>