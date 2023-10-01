<?php
    session_start();
    include_once('./utils/condb.php');

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        if(isset($email)&& isset($password)){
            $sql = "SELECT * FROM user where email = ?";
            $stmt = $condb->prepare($sql);
            $stmt->bind_param('s',$email);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if(password_verify($password,$row['password'])){

                $sql_check = "SELECT count(*) as count FROM iorder where uid = ? and status = ?";
                $stmt2 = $condb->prepare($sql_check);
                $status = '1';
                $stmt2->bind_param('ss', $row['uid'], $status);
                $stmt2->execute();
                $result_billing = $stmt2->get_result();
                $row_billing = $result_billing->fetch_assoc();

                if($row_billing['count'] == 0){

                    $sql3 = "INSERT INTO `iorder` (`uid`, `odate`, `payment_method`, `recipient_name`, `recipient_phone`, `recipient_address`, `total`, `status`) VALUES (?, current_timestamp(), NULL, NULL, NULL, NULL, '0.00', '1');";
                    $stmt3 = $condb->prepare($sql3);
                    $stmt3->bind_param('s', $row['uid']);
                    $stmt3->execute();
                    
                    if ($stmt3->affected_rows == 1) {
                        echo 'A new order has been created.';
                    }

                }



                $_SESSION['user_id'] = $row['uid'];
                $_SESSION['user_data'] = $row;

                if($_SESSION['user_data']['role'] == '2'){
                    header("Location: admin.php");
                }else{
                    header("Location: index.php");
                }

            
                
            }else{
                // echo 'ล็อกอินไม่ผ่าน';
                session_destroy();
                $_SESSION['login_error'] = 'The email and password you entered did not match our records.';
            }
            
        }else{

        }

        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./styles.css">

    <title>Login Page</title>
</head>    
<body class="_login_screen relative bg-[url('https://images.unsplash.com/photo-1513104890138-7c749659a591?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80')]">
        <div class="z-20 max-w-[40rem] h-screen bg-white flex items-center justify-center" >
                <div class="from_section">
                    <div class="topic text-2xl py-8 text-center">Sign In</div>
                    
                    <div class="max-w-[25rem] flex flex-col gap-y-4 mx-auto  py-2 px-4">
                        <form method="post">
                        <div class="group flex flex-row items-center gap-x-6  mb-6">
                            <div class="w-[25%]">Email</div>
                            <div class="w-[75%]">
                                <input placeholder="Enter your email" class="px-3 outline-none rounded-lg border p-1 hover:cursor-pointer border-gray-300" type="email" name="email" required  />
                            </div>
                        </div>

                        <div class="group flex flex-row items-center gap-x-6 mb-6">
                            <div class="w-[25%]">Password</div>
                            <div class="w-[75%]">
                                <input placeholder="Enter your password" class="px-3 outline-none rounded-lg border p-1 hover:cursor-pointer border-gray-300" type="password" name="password" required  />
                            </div>
                        </div>

                        <button type="submit" class="rounded-md w-full my-6 bg-orange-500 text-white block py-2 text-center cursor-pointer hover:bg-opacity-50 transition-all duration-300">เข้าสู่ระบบ</button>
                        </form>


                        <div class=" text-red-500 max-w-[20rem]">
                            <?php echo $_SESSION['login_error'] ? 'NOTE : ' . $_SESSION['login_error'] : '' ?>
                        </div>


                    </div>
                </div>

        </div>
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>
    </body>
</html>