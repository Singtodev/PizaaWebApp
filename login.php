<?php
    session_start();
    include_once('./utils/condb.php');


    $email = "singharatbunphim@gmail.com";
    $password = "abc123";
    
    $sql = "SELECT * FROM user where email = ?";
    $stmt = $condb->prepare($sql);
    $stmt->bind_param('s',$email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if(password_verify($password,$row['password'])){
        echo 'ล็อกอินสำเร็จ';
        $_SESSION['user_id'] = $row['uid'];
        $_SESSION['user_data'] = $row;
    }else{
        echo 'ล็อกอินไม่ผ่าน';
        session_destroy();
    }

?>