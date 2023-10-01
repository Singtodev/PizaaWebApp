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

            print_r($row);

            if(password_verify($password,$row['password'])){
                echo 'ล็อกอินสำเร็จ';
                $_SESSION['user_id'] = $row['uid'];
                $_SESSION['user_data'] = $row;
                header("Location: index.php");
                
            }else{
                // echo 'ล็อกอินไม่ผ่าน';
                session_destroy();
                $_SESSION['login_error'] = true;
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles.css">

    <title>Login Page</title>
</head>    
<body class="bodylogin">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    
    

    <div class="container">
        <div class="login-card">
            <h2>Head</h2>
                <form method="POST" action="login.php">
                    <input type="email"    name="email"    placeholder="Email"    required><br>
                    <input type="password" name="password" placeholder="Password" required><br>
                    <button type="submit">Sign in</button>
                </form>
                        <?php
                            if(isset($_SESSION['login_error'])){
                                echo '<p class="error-message">Sign in fail</p>';
                                
                            }
                        ?>
        </div>
    </div>

    </body>
</html>