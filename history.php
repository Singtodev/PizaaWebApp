<?php
    session_start();
    include_once('./utils/condb.php');
    include_once('./utils/datethai.php');
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
    <title><?php echo $title?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="./styles.css">
</head>
<body class="bg-gray-100 relative">

    <div class="toggle_menu shadow-lg z-20 top-0 right-0  transition-all duration-300 max-w-[20rem] min-w-[20rem] h-screen fixed bg-white px-4">
        <i class="toggle-menu-button cursor-pointer fa-solid fa-arrow-right text-2xl bg-white text-['#131921'] p-2 rounded-md px-2 mx-2"></i>
            <div class="h-[80%]">
                <div class="flex flex-col gap-y-4 py-4 cursor-pointer">

                    <a href="./index.php">
                        <div class="rounded-md p-2 hover:bg-gray-200 bg-opacity-50 text-left">หน้าแรก</div>
                    </a>


                    <?php
                    
                    if(isset($_SESSION['user_data'])){ ?>
                    <div class="rounded-md p-2 hover:bg-gray-200 bg-opacity-50 text-left">ตระกร้าของฉัน</div>
                    <a href="./history.php">
                    <div class="rounded-md p-2 hover:bg-gray-200 bg-opacity-50 text-left">ประวัติรายการสั่งซื้อ</div>
                    </a>
                    <div class="rounded-md p-2 hover:bg-gray-200 bg-opacity-50 text-left">ตั้งค่าบัญชี</div>
                    
                    <?php } ?>

                </div>

            </div>
            <div class="h-[20%]">
            <?php
            if(isset($_SESSION['user_data'])){ ?>
                <div class="text-center mb-2"><?php echo $_SESSION['user_data']['name'] ?></div>
                <a href="./logout.php">
                    <div class="bg-red-500 text-white rounded-md p-2 text-center">Sign Out</div>
                </a>
            <?php } ?>
            </div>


    </div>

    <div class="mx-auto lg:w-full lg:mx-0">
        <div class="relative navbar w-full bg-[#131921] h-[4rem] flex items-center">
                <div class="hidden md:flex flex-row w-full">
                    <div class="w-[30%] lg:w-[20%] flex px-5">
                        <div class="relative flex flex-col w-[5rem] h-[2.4rem] mx-5 flex items-center justify-center text-xl text-white">
                            Piazzanician
                            <span class="text-[10px] absolute left-0 top-5">by cs msu</span>
                        </div>
                    </div>

                    <div class="w-[40%] lg:w-[60%]">
                        <div class="w-full h-full bg-white rounded-tl-lg rounded-md relative ">
                            <input type="text"  class="w-full h-full px-16 outline-none rounded-md" 
                            placeholder = "Search Pizza"
                            name="search" />
                            <div class="w-[3rem] h-full absolute left-0 top-0 flex items-center text-gray-500 justify-center bg-gray-300 rounded-tl-lg">All</div>
                            <div class="w-[5rem] cursor-pointer h-full absolute right-0 top-0 flex items-center justify-center text-gray-500 bg-orange-300">Search</div>
                        </div>
                    </div>

                    <div class="w-[30%] lg:w-[20%]">
                            <div class="relative flex items-center px-4 w-full h-full text-white">
                                    <i class="fa-solid fa-cart-shopping text-2xl"></i>
                                    <div class="absolute right-10 flex flex-row gap-x-5 items-center">

                                        <?php
                                            if(!isset($_SESSION['user_data'])){ ?>
                                                <a href="./login.php">
                                                    <div class="cursor-pointer">Sign In</div>
                                                </a>

                                         <?php } ?>

                                         <?php
                                            if(isset($_SESSION['user_data'])){ ?>

                                                <div><?php echo $_SESSION['user_data']['name'] ?></div>
                                                <div class="
                                                w-[2.2rem]
                                                h-[2.2rem]
                                                rounded-full
                                                bg-cover
                                                object-cover
                                                bg-center
                                                bg-no-repeat
                                                bg-[url('<?php echo $_SESSION['user_data']['photo'] ?>')]">

                                                </div>
                 

                                         <?php } ?>

                                         <i class="toggle-menu-button fa-solid cursor-pointer fa-bars text-2xl"></i>
 
                    
                                    </div>
                            </div>
                    </div>
  

                </div>
        </div>
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
                    <div class="flex flex-row gap-x-2  ">
                        <div><?= $row['status'] == 3 ?  'ราคาทั้งหมด ' . $row['total'] : '' ?></div>
                    </div>
                    <div class="flex flex-row gap-x-2  ">
                        <div><?= getThaiDateWithTime($row['odate']) ?></div>
                    </div>

                </div>
                <div class="grid grid-cols-2">
                        <div class="text-center rounded-md <?=$row['status'] == 2 ? 'bg-gray-700 text-white': '' ?>">ยังไม่ส่ง</div>
                        <div class="text-center rounded-md <?=$row['status'] == 3 ? 'bg-lime-700 text-white': '' ?>">จัดส่งแล้ว</div>
                </div>

            </div>
            </a>

       <?php }  ?>  
    </div>

    <script>
        $(document).ready(function(){            
        $('.toggle-menu-button').click(function(){
            var dom = document.getElementsByClassName("toggle_menu")[0];
            dom.classList.toggle("active");
        })
        });

    </script>

</body>
</html>

