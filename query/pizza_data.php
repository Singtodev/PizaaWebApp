
<?php 

    include_once('../utils/condb.php');
    include_once('../components/view/pizza_card_item.php');

    $formatted_size = array_map(function($char) {
        return "'$char'";
    }, $_GET['sizes']);

    $sizes = '(' . implode(', ', $formatted_size) . ')';

    $formatted_type = array_map(function($char) {
        return "'$char'";
    }, $_GET['types']);
    
    $types = '(' . implode(', ', $formatted_type) . ')';

    $formatted_crust = array_map(function($char) {
        return "'$char'";
    }, $_GET['crusts']);
    
    $crusts = '(' . implode(', ', $formatted_crust) . ')';
?>

<div class="w-full grid grid-cols-1 md:grid-cols-2 md:gap-x-5 lg:grid-cols-4  lg:gap-x-10 gap-y-10">
                <?php
                    $sql = "SELECT  food.fid, food.description , food.price ,food.image, 
                    food.name as f_name,
                    food_type.name as f_type_name,
                    food_size.name as f_size_name,
                    food_crust.name as f_crust_name
                    FROM        food , food_type , food_size, food_crust
                    where       food.ftid = food_type.ftid 
                    and         food.fsid = food_size.fsid
                    and         food.fcid = food_crust.fcid
                    and         food_size.name in $sizes
                    and         food_type.name in $types
                    and         food_crust.name in $crusts
                    order by food.fid";

                $result = $condb->query($sql);
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


