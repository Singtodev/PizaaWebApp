<?php
    session_start();
    include_once('./utils/condb.php');
    include_once('./utils/datethai.php');
    include_once('./components/view/navbar.php');
    include_once('./components/view/sidebar.php');

    if($_SESSION['user_data']['role'] != '2'){
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
        <div class="title text-2xl text-right py-4 px-4 ">หน้าผู้ดูแลระบบ</div> 
        <div class="title text-xl text-left py-4 px-4 ">รายงานผลรวม</div> 
        <div class="grid grid-cols-3 h-[10rem] gap-4 my-4">
            <div class="bg-gray-300 p-2 shadow-xl" >
                    <div class="mx-2 text-2xl">ยอดขายกี่ชิ้นวันนี้</div>
                    <div class="mx-2 text-2xl mt-10 text-xl text-right">10 รายการ</div>
            </div>
            <div class="bg-orange-300 p-2 shadow-xl" >
                    <div class="mx-2 text-2xl">ยอดขายกี่ชิ้นเดือนนี้</div>
                    <div class="mx-2 text-2xl mt-10 text-xl text-right">100 รายการ</div>
            </div>
            <div class="bg-yellow-300 p-2 shadow-xl" >
                    <div class="mx-2 text-2xl">ยอดขายกี่ชิ้นปีนี้</div>
                    <div class="mx-2 text-2xl mt-10 text-xl text-right">250 รายการ</div>
            </div>
        </div>

        <div class="grid grid-cols-3 h-[10rem] gap-4">
            <div class="bg-gray-300 p-2 shadow-xl" >
                    <div class="mx-2 text-2xl">ยอดขายวันนี้</div>
                    <div class="mx-2 text-2xl mt-10 text-xl text-right">10000 THB</div>
            </div>
            <div class="bg-orange-300 p-2 shadow-xl" >
                    <div class="mx-2 text-2xl">ยอดขายเดือนนี้</div>
                    <div class="mx-2 text-2xl mt-10 text-xl text-right">25552 THB</div>
            </div>
            <div class="bg-yellow-300 p-2 shadow-xl" >
                    <div class="mx-2 text-2xl">ยอดขายปีนี้</div>
                    <div class="mx-2 text-2xl mt-10 text-xl text-right">123135 THB</div>
            </div>
        </div>

        <div class="title text-xl text-left py-4 px-4 ">รายการที่ต้องตรวจสอบ</div> 




        <div class="grid grid-cols-1">
                    <div class="w-full grid grid-cols-5 py-4">
                            <div class="px-1"> รหัสออเดอร์ #</div>
                            <div class="px-1"> รหัสลูกค้า  #</div>
                            <div class="px-1"> ชื่อลูกค้า  #</div>
                            <div class="px-1"> จำนวนเงิน #</div>
                            <div class="px-1"> Action</div>
                    </div>
            <?php 
                $sql = "SELECT * 
                        FROM iorder , user
                        where iorder.uid = user.uid
                        and  iorder.status = 2";
                $result = $condb->query($sql);
                $i = 0;
                while($row = $result->fetch_assoc()){  $i++ ?>
                    <div class="w-full grid grid-cols-5 py-4 <?php echo ($i % 2 == 0 ? 'bg-white' : 'bg-gray-200'); ?>">
                            <div class="px-1"><?php echo $row['oid'] ?></div>
                            <div class="px-1"><?php echo $row['uid'] ?></div>
                            <div class="px-1"><?php echo $row['name'] ?></div>
                            <div class="px-1"><?php echo $row['total'] ?></div>
                            <div class="flex gap-x-2">
                                <div class="cursor-pointer hover:bg-opacity-50 transition-all duration-300 bg-lime-600 px-4 text-white rounded-md">ยินยัน</div>
                            </div>
                    </div>
                <?php } ?>


        </div>



    </div>

    <?php
            include_once('./utils/toggle_menu.php');
     ?>

</body>
</html>

