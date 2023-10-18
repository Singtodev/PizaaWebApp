<?php
    session_start();
    include_once('./utils/condb.php');
    include_once('./utils/datethai.php');
    include_once('./components/view/navbar.php');
    include_once('./components/view/sidebar.php');

    $items = array();
    $totals = 0;

    if(isset($_SESSION['user_data']) && isset($_GET['oid'])){
        $sql = " SELECT odid,order_amount.fsid  as o_fsid, order_amount.fcid as o_fcid , order_amount.oid,
                 food.name, food.image as image, food_size.name as size_name ,food_crust.name as crust_name ,
                 order_amount.amount as quantity ,((food_type.price + food_crust.price + food_size.price) * order_amount.amount) as total,
                 iorder.recipient_name as recipient_name , iorder.recipient_phone as recipient_phone,iorder.recipient_address as recipient_address
                 FROM  order_amount ,food, food_crust ,food_size , food_type, iorder
                 WHERE order_amount.fid  = food.fid
                 AND   food.ftid         = food_type.ftid
                 AND   order_amount.fcid = food_crust.fcid
                 AND   order_amount.fsid = food_size.fsid
                 AND   order_amount.oid  =  iorder.oid
                 AND   order_amount.oid  = ?
                 order by odid DESC
        ";
        $stmt = $condb->prepare($sql);
        $stmt->bind_param('s',$_GET['oid']);
        $stmt->execute();
        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()){
            array_push($items,$row);
            $totals += $row['total'];
        }


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

        <div class="flex flex-row justify-between my-5">
            <div class="title text-xl text-left ">Bill ID <?= $_GET['oid']?></div> 
            <div class="flex text-xl flex-row gap-x-2">ยอดรวมทั้งหมด <div><?php echo $totals ?> THB</div></div>
        </div>




        <?php

            foreach($items as $item){ ?>
                    <div class="w-full grid grid-cols-4 h-[10rem]">
                        <div class="bg-cover object-contain bg-no-repeat bg-center rounded-md my-2 bg-[url('<?php echo $item['image'] ?>')]"></div>
                        <div class="text-md flex flex-row flex-wrap items-center justify-center px-5">
                        <?=$item["name"]?> 
                        ขนาดไซด์ <?= $item['size_name'] ?>
                        ขอบ <?= $item['crust_name'] ?>
                        </div>
                        <div class="text-md flex items-center  justify-center"> x <?= $item['quantity'] ?></div>
                        <div class="text-md flex items-center  justify-center"> <?= $item['total'] ?> THB</div>
                    </div>
                    
            <?php } ?>


    </div>

    <?php
            include_once('./utils/toggle_menu.php');
     ?>

</body>
</html>

