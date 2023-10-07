
<?php 
    session_start();
    include_once('../utils/condb.php');
    include_once('../components/view/pizza_card_item.php');


?>

<div class="w-full grid grid-cols-1 md:grid-cols-2 md:gap-x-5 lg:grid-cols-4  lg:gap-x-10 gap-y-10">
                <?php

                    $sizes =  $_GET['sizes'];  // An array of food sizes
                    $crusts = $_GET['crusts'];
                    $types  = $_GET['types'];
                    
                    // Generate the placeholders for the IN clause for sizes
                    $placeholders_sizes = implode(',', array_fill(0, count($sizes), '?'));

                    // Generate the placeholders for the IN clause for crusts
                    $placeholders_crusts = implode(',', array_fill(0, count($crusts), '?'));

                    // Generate the placeholders for the IN clause for types
                    $placeholders_types = implode(',', array_fill(0, count($types), '?'));

                    $sql = "SELECT food.fid, food.description, (food_type.price + food_size.price + food_crust.price) as price, food.image,
                            food.name as f_name, food_type.name as f_type_name, food_size.name as f_size_name, food_crust.name as f_crust_name
                            FROM food
                            JOIN food_type ON food.ftid = food_type.ftid
                            JOIN food_size ON food.fsid = food_size.fsid
                            JOIN food_crust ON food.fcid = food_crust.fcid
                            WHERE food_size.name IN ($placeholders_sizes)
                            AND food_crust.name IN ($placeholders_crusts)
                            AND food_type.name IN ($placeholders_types)
                            ORDER BY food.fid DESC";


                    $stmt = $condb->prepare($sql);

                    // Bind parameters for sizes and crusts
                    $params = array_merge($sizes, $crusts , $types);
                    $types = str_repeat('s', count($params));
                    $stmt->bind_param($types, ...$params);

                    $stmt->execute();
                    $result = $stmt->get_result();

                    
                    while($row = $result->fetch_assoc()) { ?>
                        <?php
                            $card = new PizzaCardItem();
                            $card->build($row);
                        ?>
                    <?php } ?>


                    <?php
                    if($result->num_rows == 0){
                        echo '<div class="col-span-4 bg-white w-full h-full min-h-[40rem] flex items-center justify-center">ขออภัย ไม่พบข้อมูล.</div>';
                    }
                ?>

            </div>


