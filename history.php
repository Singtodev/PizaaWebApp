<?php
    session_start();
    include_once('./utils/condb.php');
    include_once('./utils/datethai.php');
    include_once('./components/view/navbar.php');
    include_once('./components/view/sidebar.php');
    $result;
    
    if(isset($_SESSION['user_data'])){
        $sql = "select * from iorder where uid = ? and status != 1 order by oid desc";
        $stmt = $condb->prepare($sql);
        $stmt->bind_param('s',$_SESSION['user_data']['uid']);
        $stmt->execute();
        $result = $stmt->get_result();
    }else{
        header("Location: index.php");
    }





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="./styles.css">
</head>
<body class="bg-gray-100 relative">

    <div class="toggle_menu shadow-lg z-20 top-0 right-0  transition-all duration-300 max-w-[20rem] min-w-[20rem] h-screen fixed bg-white px-4">
                <?php
                    $sidebarComponent = new SidebarComponent();
                    echo $sidebarComponent->build();
                ?>

    </div>

    <div class="mx-auto lg:w-full lg:mx-0">
                <?php
                    $navbarComponent = new NavbarComponent($condb);
                    echo $navbarComponent->build();
                ?>
    </div>

    <div class="max-w-[60rem] bg-white py-2 my-2 mx-auto px-4 rounded-md">
        <div class="title text-2xl text-right py-4 px-4">รายการสั่งซื้อทั้งหมด <?= $result->num_rows ?> รายการ</div>
        <?php
        $i = 0;
        while($row = $result->fetch_assoc()){
             $i++;
            ?>
            <a href="./history_show.php?oid=<?= $row['oid']?>">
            <div class="flex flex-col py-2  border-b border-gray-300 cursor-pointer hover:bg-gray-300 px-2 transition-all duration-300 hover:bg-opacity-50 rounded-md">
                <div class="h-auto pb-6 pt-4  ">
                    <div>Order ID <?= $row['oid'] ?> </div>
                    <div class="flex flex-col gap-x-2  ">
                        <div>ยอดรวม <?= $row['total'] ?> THB </div>
                        <div><?= $row['recipient_address'] ?></div>
                        <div><?= $row['recipient_phone'] ?></div>
                        <div>ชำระแบบ <?= $row['payment_method'] ?></div>
                    </div>
                    <div class="flex flex-row gap-x-2  ">
                        <div><?= getThaiDateWithTime($row['odate']) ?></div>
                    </div>

                </div>
                <div class="grid grid-cols-2">
                        <div class="text-center rounded-md <?=$row['status'] == 2 ? 'bg-gray-700 text-white': '' ?>">ชำระเงินแล้ว</div>
                        <div class="text-center rounded-md <?=$row['status'] == 3 ? 'bg-lime-700 text-white': '' ?>">จัดส่งแล้ว</div>
                </div>

            </div>
            </a>

       <?php }  ?>  
    </div>

    <?php
            include_once('./utils/toggle_menu.php');
     ?>

</body>
</html>

