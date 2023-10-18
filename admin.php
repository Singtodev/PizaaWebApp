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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    <div class="max-w-[85rem] bg-white py-2 my-2 mx-auto px-4 rounded-md">
        <div class="title text-2xl text-right py-4 px-4 ">หน้าผู้ดูแลระบบ</div> 


        <div class="my-2 mb-10">
            <div class="title text-xl text-left py-4 px-4 ">รายงานผลรวม</div> 
            <?php
            $sql_day = "SELECT SUM(amount) AS total 
                       FROM iorder ,order_amount 
                       where order_amount.oid = iorder.oid 
                       and DATE(iorder.odate) = DATE(CURDATE()) 
                       AND status = 3";

            $sql_month = "SELECT SUM(amount) AS total 
            FROM iorder ,order_amount 
            where order_amount.oid = iorder.oid 
            and MONTH(iorder.odate) = MONTH(CURDATE()) 
            AND status = 3";

            $sql_year= "SELECT SUM(amount) AS total 
            FROM iorder ,order_amount 
            where order_amount.oid = iorder.oid 
            and YEAR(iorder.odate) = YEAR(CURDATE()) 
            AND status = 3";

            $sum_total_day = $condb->query($sql_day);
            $result_total_day = $sum_total_day->fetch_assoc();

            $sum_total_month = $condb->query($sql_month);
            $result_total_month = $sum_total_month->fetch_assoc();

            $sum_total_year = $condb->query($sql_year);
            $result_total_year = $sum_total_year->fetch_assoc();
            
            ?>
            <div class="grid grid-cols-3 h-[10rem] gap-4 my-4">
                <div class="bg-gray-300 p-2 shadow-xl" >
                        <div class="mx-2 text-2xl">ยอดขายกี่ชิ้นวันนี้</div>
                        <div class="mx-2 text-2xl mt-10 text-xl text-right"><?php echo $result_total_day['total'] ?> รายการ</div>
                </div>
                <div class="bg-orange-300 p-2 shadow-xl" >
                        <div class="mx-2 text-2xl">ยอดขายกี่ชิ้นเดือนนี้</div>
                        <div class="mx-2 text-2xl mt-10 text-xl text-right"><?php echo $result_total_month['total'] ?> รายการ</div>
                </div>
                <div class="bg-yellow-300 p-2 shadow-xl" >
                        <div class="mx-2 text-2xl">ยอดขายกี่ชิ้นปีนี้</div>
                        <div class="mx-2 text-2xl mt-10 text-xl text-right"><?php echo $result_total_year['total'] ?> รายการ</div>
                </div>
            </div>

            <div class="grid grid-cols-3 h-[10rem] gap-4">

                <?php

                    $sql_day = "SELECT  coalesce(SUM(total) , 0) AS total
                    FROM iorder
                    WHERE DATE(odate) = DATE(CURDATE())
                    AND status = 3
                    ";
                
                    $sql_month = "SELECT coalesce(SUM(total) , 0) AS total
                    FROM iorder
                    WHERE MONTH(odate) = MONTH(CURDATE())
                    AND status = 3
                    ";

                    $sql_year = "SELECT coalesce(SUM(total) , 0) AS total
                    FROM iorder
                    WHERE YEAR(odate) = YEAR(CURDATE())
                    AND status = 3
                    ";

                    $sum_total_day = $condb->query($sql_day);
                    $result_total_day = $sum_total_day->fetch_assoc();

                    $sum_total_month = $condb->query($sql_month);
                    $result_total_month = $sum_total_month->fetch_assoc();

                    $sum_total_year = $condb->query($sql_year);
                    $result_total_year = $sum_total_year->fetch_assoc();

                ?>


                <div class="bg-gray-300 p-2 shadow-xl" >
                        <div class="mx-2 text-2xl">ยอดขายวันนี้</div>
                        <div class="mx-2 text-2xl mt-10 text-xl text-right"><?php echo $result_total_day['total'] ?> THB</div>
                </div>
                <div class="bg-orange-300 p-2 shadow-xl" >
                        <div class="mx-2 text-2xl">ยอดขายเดือนนี้</div>
                        <div class="mx-2 text-2xl mt-10 text-xl text-right"><?php echo $result_total_month['total'] ?> THB</div>
                </div>
                <div class="bg-yellow-300 p-2 shadow-xl" >
                        <div class="mx-2 text-2xl">ยอดขายปีนี้</div>
                        <div class="mx-2 text-2xl mt-10 text-xl text-right"><?php echo $result_total_year['total'] ?> THB</div>
                </div>



            </div>
        </div>



        <?php

        $re_check = array();
        $done = array();

        $sql = "SELECT * 
        FROM  iorder , user
        where iorder.uid = user.uid

        order by odate DESC";
        $result = $condb->query($sql);

        while($row = $result->fetch_assoc()){
            switch($row['status']){
                case "2":
                    array_push($re_check,$row);
                    break;
                case "3":
                    array_push($done,$row);
            }
        }


        $i = 0;
        
        ?>

        <div class="flex flex-row gap-x-4">
                <div data-name="2" class="menu-select rounded-md btn-active transition-all duration-300 px-3 border-r cursor-pointer">
                    รอการตรวจสอบ 
                    <?php echo count($re_check) > 0 ? '<span class="bg-red-500 mx-2 rounded-md px-2 text-white">' . count($re_check).'</span>' : ''  ?>
                 </div>
                <div data-name="3" class="menu-select rounded-md transition-all duration-300 px-3 border-r cursor-pointer ">
                    สำเร็จแล้ว
                    <?php echo count($done) > 0 ? '<span class="bg-red-500 mx-2 rounded-md px-2 text-white">' . count($done).'</span>' : ''  ?>
 
                </div>
        </div>

        <div id="pizza_admin_table" class="grid grid-cols-1">

                    <?php
                    
                    if(count($re_check) != 0){ ?>
                        <div class="w-full grid grid-cols-7 py-4">
                                <div class="px-1"># รหัสออเดอร์ </div>
                                <div class="px-1"># ลูกค้า  </div>
                                <div class="px-1"># ที่อยู่จัดส่ง  </div>
                                <div class="px-1"># วันที่ </div>
                                <div class="px-1"></div>
                                <div class="px-1"># จำนวนเงิน </div>
                                <div class="px-1"></div>
                        </div>
                    <?php }?>

                    <?php
                        if(count($re_check) == 0){
                            echo '<div class="text-center py-2">ไม่มีข้อมูล</div>';
                        }
                    ?>

            <?php 
                foreach($re_check as $key=>$row){ ?>
                    <div class="w-full grid grid-cols-7 py-4 <?php echo (($key + 1) % 2 == 0 ?  'bg-gray-200'  : 'bg-white' ) ; ?>">
                            <div class="px-4 whitespace-nowrap"><?php echo $row['oid'] ?></div>
                            <div class="px-1 whitespace-nowrap"><?php echo $row['name'] ?></div>
                            <div class="px-1 whitespace-wrap"><?php echo $row['recipient_address'] ?></div>
                            <div class="px-1 whitespace-nowrap"><?php echo getThaiDateWithTime($row['odate']) ?></div>
                            <div class="px-1"></div>
                            <div class="px-1 whitespace-nowrap"><?php echo $row['total'] ?></div>
                            <div class="inline-block flex items-center">

                                <?php 
                                    if($row['status'] == 2 ){ ?>
                                    <div class="flex flex-row item-center gap-x-2">
                                        <div oid="<?= $row['oid'] ?>" class="confirm-order whitespace-wrap flex items-center justify-center cursor-pointer hover:bg-opacity-50 transition-all duration-300 bg-blue-600 gap-x-4 px-2 text-white rounded-md">อนุมัติ <i class="fa-solid fa-check"></i></div>
                                        <a href="history_show.php?oid=<?= $row['oid'] ?>" class="h-full">
                                            <div class="whitespace-wrap py-2 w-full h-full flex items-center justify-center cursor-pointer hover:bg-opacity-50 transition-all duration-300 bg-yellow-600 px-2 text-white rounded-md"><i class="fa-solid fa-eye"></i></div>
                                        </a>
                                    </div>
                                <?php } ?>

                                <?php 
                                    if($row['status'] == 3 ){ ?>
                                    <div class="flex flex-row item-center gap-x-2">
                                    <div class="whitespace-wrap flex items-center justify-center transition-all duration-300 bg-lime-600 gap-x-4 px-2 text-white rounded-md">สำเร็จ</div>
                                            <a href="history_show.php?oid=<?= $row['oid'] ?>" class="h-full">
                                            <div class="whitespace-wrap py-2 w-full h-full flex items-center justify-center cursor-pointer hover:bg-opacity-50 transition-all duration-300 bg-yellow-600 px-2 text-white rounded-md"><i class="fa-solid fa-eye"></i></div>
                                        </a>
                                    </div>
                                <?php } ?>

                            </div>
                    </div>
                <?php } ?>


        </div>



    </div>

    <script>

            function removeAllActiveMenu(){
                var doms = document.querySelectorAll('.menu-select');
                for(let i = 0 ; i < doms.length; i++ ){
                    doms[i].classList.remove("btn-active");
                }
            }

            $(document).ready(function(){

                $(".confirm-order").click((e) => {

                    var oid = e.currentTarget.attributes['oid'].value;

                    Swal.fire({
                                    title: 'ยืนยันการจัดส่งอาหาร',
                                    text: 'หากคุณมั่นใจว่าส่งอาหารเรียบร้อยแล้ว',
                                    icon: 'info',
                                    showCancelButton: true,
                                    confirmButtonColor: '#2563eb',
                                    cancelButtonColor: '#131921',
                                    cancelButtonText: 'ยกเลิก',
                                    confirmButtonText: 'ตกลง'
                                    }).then((result) => {
                                    if (result.isConfirmed) {
                                        $.ajax({
                                            url: './query/pizza_order_update.php',
                                            method: 'GET',
                                            data: { 
                                                oid: oid,
                                                status: 3
                                            },
                                            success: function(response) {   
                                                console.log(response);
                                                var data = JSON.parse(response);

                                                if(data.status == 400){
                                                    Swal.fire(
                                                    'ไม่สำเร็จ!',
                                                    data.message,
                                                    'error'
                                                    )
                                                }

                                                if(data.status == 200){
                                                    Swal.fire(
                                                    'สำเร็จ!',
                                                    'ยืนยันการส่งอาหารเรียบร้อย',
                                                    'success'
                                                    )
                                                }

                                                setTimeout(() => {
                                                    window.location.reload();
                                                }, 1000)
                                            },
                                            error: function() {
                                                console.log("filter error");
                                            }
                                        });;
                                  }
                    });
                })

                $(".menu-select").click((e) => {
                    var id = e.currentTarget.attributes['data-name'].value;
                    $.ajax({
                        url: './query/pizza_admin_table.php',
                        method: 'GET',
                        data: { 
                            show_id: id
                        },
                        success: function(response) {   
                            // replace data table
                            $('#pizza_admin_table').html(response);
                        },
                        error: function() {
                            console.log("filter error");
                        }
                    });

                    // remove navbar active
                    removeAllActiveMenu();

                    // set active index
                    e.currentTarget.classList.add("btn-active");
                });
            });


    </script>

    <?php
            include_once('./utils/toggle_menu.php');
     ?>

</body>
</html>

