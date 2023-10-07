<?php
    session_start();
    if(!isset($_GET['f_id'])){
        header("Location: index.php");
        exit(0);
    }


    include_once('./utils/condb.php');
    include_once('./components/view/navbar.php');
    include_once('./components/view/sidebar.php');

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
<body>

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


        <?php 
        
            // section query food by id

            $sql = "SELECT food.fid, food.description, (food_type.price + food_size.price + food_crust.price) as price, food.image,
            food.name as f_name, food_type.name as f_type_name, food_size.name as f_size_name, food_crust.name as f_crust_name,
            food_type.price as price_start
            FROM    food
            JOIN    food_type ON food.ftid = food_type.ftid
            JOIN    food_size ON food.fsid = food_size.fsid
            JOIN    food_crust ON food.fcid = food_crust.fcid
            WHERE   food.fid = ?
            ";

            $stmt = $condb->prepare($sql);
            $stmt->bind_param('s',$_GET['f_id']);
            $stmt->execute();
            $result = $stmt->get_result();

        ?>




        <?php
        
            if($result->num_rows == 1){ 
                $row = $result->fetch_assoc();
                 ?>

            <div class="w-full lg:max-w-[70rem] min-h-[50rem] h-[60rem]  mx-auto lg:py-14 mb-8">
                    <div class="w-full bg-white h-full shadow-2xl p-4 rounded-md">

                        <div class="flex flex-row items-center justify-between gap-x-2">
                            <a href="index.php">
                                <div class="px-6 py-2 rounded-md cursor-pointer border border-gray-300 inline-block">ย้อนกลับ</div>
                            </a>
                            <div class="text-xl font-bold"><?= $row['f_name'] ?></div>
                        </div>

                        <div class="grid grid-cols-1 h-[30rem] gap-4 py-4">
                            <div class="w-full h-[30rem] bg-cover bg-no-repeat object-cover rounded-md bg-center bg-[url('<?php echo $row['image']?>')]"></div>
                            <div class="flex flex-col gap-y-4 min-h-[5rem]">
                                <div class="text-md"><?= $row['description'] ?></div>
                                <div class="text-xl">ประเภท: <?= $row['f_type_name']?></div>
                                <div class="text-xl px-4 justify-end flex">ราคาเริ่มต้น: <span class="text-red-500 px-2"> <?= $row['price_start']?></span> ฿ </div>
                            </div>
                        </div>




                    </div>


            </div>

            <?php } ?>


        <?php
            if($result->num_rows == 0){ ?>
                <div class="text-center items-center justify-center py-4">Oops!..  ไม่เจอพิซซ่าที่คุณค้นหากรุณาลองใหม่อีกครั้ง</div>
        <?php }?>


        <?php
            include_once('./utils/toggle_menu.php');
         ?>

    </body>
    
</body>
</html>