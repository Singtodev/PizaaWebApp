$sizes = ['L' , 'M' , 'XL'];  // An array of food sizes
                        $crusts = ['บางกรอบ' , 'บางกรอบ'];

                        // Generate the placeholders for the IN clause
                        $placeholders_sizes = implode(',', array_fill(0, count($sizes), '?'));
                        $placeholders_crusts = implode(',', array_fill(0, count($crusts), '?'));


                        $sql = "SELECT food.fid, food.description, (food.price + food_size.price + food_crust.price) as price, food.image,
                                        food.name as f_name, food_type.name as f_type_name, food_size.name as f_size_name, food_crust.name as f_crust_name
                                FROM food, food_type, food_size, food_crust
                                WHERE food.ftid = food_type.ftid
                                AND food.fsid = food_size.fsid
                                AND food.fcid = food_crust.fcid
                                AND food_size.name IN ($placeholders_sizes)
                                AND food_crust.name IN ($placeholders_crusts)
                                ORDER BY food.fid";


                        // debug
                        
                        echo 'SQL: ' . $sql . PHP_EOL;  // Print the SQL statement

                        // TODO Query with clean
                        $stmt = $condb->prepare($sql);


                        // section bind sizes value with dynamic

                            // check array sizes and repeat string if size = 3 return sss ;
                            $bindParams = str_repeat('s', count($sizes));

                            // Prepare an array of values to bind
                            // return Array (0 => 'sss' ,1 => l, 2 => M , 3 => XL );
                            $bindValues = array_merge([$bindParams], $sizes);
    
                            // Use call_user_func_array to pass the array of values to bind_param dynamically                            
                            call_user_func_array([$stmt, 'bind_param'], $bindValues);

  
                        // section bind types value with dynamic
                            $bindParams = str_repeat('s', count($crusts));
       
                            $bindValues = array_merge([$bindParams], $crusts);
                            print_r($bindValues);
                            call_user_func_array([$stmt, 'bind_param'], $bindValues);
      

                            echo 'x';
          

                        $stmt->execute();  // Execute the SQL statement
                        $result = $stmt->get_result();

                        print_r($result);