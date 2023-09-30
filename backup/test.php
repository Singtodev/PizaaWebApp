<?php
                        $sql = "SELECT      food.fid, food.description , (food.price  + food_size.price + food_crust.price ) as price ,food.image, 
                                            food.name as f_name,
                                            food_type.name as f_type_name,
                                            food_size.name as f_size_name,
                                            food_crust.name as f_crust_name
                                FROM        food , food_type , food_size, food_crust
                                where       food.ftid = food_type.ftid 
                                and         food.fsid = food_size.fsid
                                and         food.fcid = food_crust.fcid
                                order by food.fid";
                                
                        $result = $condb->query($sql);
                        while($row = $result->fetch_assoc()) { ?>

                                <?php
                                    $card = new PizzaCardItem();
                                    $card->build($row);
                                ?>

                        <?php } ?>