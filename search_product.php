<?php
    session_start();
    include_once('./utils/condb.php');
    include_once('./utils/datethai.php');
    include_once('./components/view/navbar.php');
    include_once('./components/view/sidebar.php');
    include_once('./components/view/pizza_card_item.php');

    $search = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : '';
    $sql = "SELECT food.fid, food.description, (food_type.price + food_size.price + food_crust.price) AS price, food.image,
    food.name AS f_name, food_type.name AS f_type_name, food_size.name AS f_size_name, food_crust.name AS f_crust_name
    FROM food
    JOIN food_type ON food.ftid = food_type.ftid
    JOIN food_size ON food.fsid = food_size.fsid
    JOIN food_crust ON food.fcid = food_crust.fcid
    WHERE food.name LIKE ?
    OR food_type.name LIKE ?
    OR food_size.name LIKE ?
    OR food_crust.name LIKE ?
    ORDER BY food.fid DESC";

    $stmt = $condb->prepare($sql);
    $stmt->bind_param("ssss", $search,$search,$search,$search);
    $stmt->execute();
    $result = $stmt->get_result();




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
        <?php


            if($result->num_rows == 0){
                echo '<div class="flex w-full items-center justify-center py-3"> ไม่พบข้อมูล </div>';
                exit(0);
            }
        
        ?>
        <section id="section-pizza-show">
                    <div class="w-full grid grid-cols-1 md:grid-cols-2 md:gap-x-5 lg:grid-cols-3  lg:gap-x-10 gap-y-10">
                        <?php

                        
                            while($row = $result->fetch_assoc()) { ?>

                                    <?php
                                        $card = new PizzaCardItem();
                                        $card->build($row);
                                    ?>

                            <?php } ?>
                    </div>
      </section>
    </div>

    <?php
            include_once('./utils/toggle_menu.php');
     ?>

</body>
</html>

