<?php

                        $sizes = ['S','M', 'L', 'XL'];  // An array of food sizes
                        $crusts = ['หนาหนุ่ม','บางกรอบ','ขอบชีส'];
                        $types  = ['พิซซ่าหน้าเหลี่ยม','พิซซ่าหน้าวงกลม','พิซซ่าหน้าสามเหลียม','พิซซ่าหน้าหกเหลี่ยม'];
                        // Generate the placeholders for the IN clause for sizes
                        $placeholders_sizes = implode(',', array_fill(0, count($sizes), '?'));

                        // Generate the placeholders for the IN clause for crusts
                        $placeholders_crusts = implode(',', array_fill(0, count($crusts), '?'));

                        // Generate the placeholders for the IN clause for types
                        $placeholders_types = implode(',', array_fill(0, count($types), '?'));

                        $sql = "SELECT food.fid, food.description, (food.price + food_size.price + food_crust.price) as price, food.image,
                                food.name as f_name, food_type.name as f_type_name, food_size.name as f_size_name, food_crust.name as f_crust_name
                                FROM food
                                JOIN food_type ON food.ftid = food_type.ftid
                                JOIN food_size ON food.fsid = food_size.fsid
                                JOIN food_crust ON food.fcid = food_crust.fcid
                                WHERE food_size.name IN ($placeholders_sizes)
                                AND food_crust.name IN ($placeholders_crusts)
                                AND food_type.name IN ($placeholders_types)
                                ORDER BY food.fid";

                        echo 'SQL: ' . $sql . PHP_EOL;

                        $stmt = $condb->prepare($sql);

                        // Bind parameters for sizes and crusts
                        $params = array_merge($sizes, $crusts , $types);
                        $types = str_repeat('s', count($params));
                        $stmt->bind_param($types, ...$params);

                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Print the result
                        while ($row = $result->fetch_assoc()) {
                            print_r($row);
                        }

                        // Close the statement and connection when done
                        $stmt->close();
                        $condb->close();



?>