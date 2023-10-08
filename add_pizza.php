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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            food_type.price as price_start , food.fcid, food.fsid , food.ftid
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
                            <div class="text-xl font-bold"></div>
                        </div>


                        <div class="grid grid-cols-2 h-[30rem] gap-4 py-4">
                            <img id="image" 
                                src="<?php echo $row['image']?>"
                            class="w-full h-[30rem] bg-cover bg-no-repeat object-cover rounded-md bg-center"></img>
                            <div class="flex flex-col gap-y-12 min-h-[5rem]">

                                <?php
                                
                                    $sql = "SELECT distinct name , fid , image from food";
                                    $result = $condb->query($sql);
                                    $foods = array();

                                    while($data = $result->fetch_assoc()){
                                        array_push($foods,$data);
                                    }
                                ?>


                                <?php
                                
                                    $sql = "SELECT fsid , name , price  from food_size";
                                    $result = $condb->query($sql);
                                    $sizes = array();

                                    while($data = $result->fetch_assoc()){
                                        array_push($sizes,$data);
                                    }
                                ?>

                                <?php
                                    
                                    $sql = "SELECT fcid , name  , price from food_crust";
                                    $result = $condb->query($sql);
                                    $crusts = array();

                                    while($data = $result->fetch_assoc()){
                                        array_push($crusts,$data);
                                    }
                                ?>


                                <select id="fid" class="py-4 px-6 outline-none border-gray-300 rounded-md">
                                        <?php
                                            foreach($foods as $item){?>
                                               <option <?php echo ($row['fid'] == $item['fid'] ? 'selected' : '') ?> value="<?= $item['fid'] ?>"><?= $item['name']?></option>
                                        <?php }?>

                                </select>
                                <!-- <div class="text-md">ประเภท: <?= $row['f_type_name']?></div> -->
                                <div id="description" class="text-md"><?= $row['description'] ?></div>
                               


                                <div class="grid grid-cols-3 items-center">
                                    <div>เลือกขนาด</div>
                                    <div class="col-span-2 flex flex-row gap-x-2">
                                            <?php
                                                foreach($sizes as $item){?>
                                                <div class="flex flex-row bg-gray-200 px-2 rounded-md">
                                                <input 
                                                        type="radio"
                                                        name="size"
                                                        class="sizeId"
                                                        <?php echo ($row['fsid'] == $item['fsid'] ? 'checked' : '') ?>
                                                        value="<?= $item['fsid'] ?>"
                                                    ><span class="px-4 cursor-pointer"><?= $item['name']?></span></input>
                                                                                                    
                                                </div>
                                            <?php }?>
                                    </div>
                                </div>
                                


                                <div class="grid grid-cols-3 items-center">
                                    <div>เลือกขอบ</div>
                                    <select id="curstId" class="col-span-2 py-4 px-6 outline-none border-gray-300 rounded-md">
                                            <?php
                                                foreach($crusts as $item){?>
                                                <option  <?php echo ($row['fcid'] == $item['fcid'] ? 'selected' : '') ?> value="<?= $item['fcid'] ?>"><?= $item['name']?></option>
                                            <?php }?>

                                    </select>
                                </div>
                                <div  class="text-xl px-4 justify-end flex">ราคา: <span class="text-red-500 px-2 " id="price_total"> <?= $row['price']?></span> ฿ </div>
                                

                                <div id="add_to_cart" class="inline-block flex items-center cursor-pointer transition-all duration-300 hover:bg-opacity-50 bg-green-500 px-4 py-2 rounded-md text-white">
                                    <i class="fa-solid cursor-pointer fa-plus inline-block  text-white px-2 rounded-full hover:bg-opacity-50 transition-all duration-300 text-2xl text-white"></i> เพิ่มลงตระกร้า
                                </div>
                            </div>
                        </div>




                    </div>


            </div>

            <?php } ?>


        <?php
            if($result->num_rows == 0){ ?>
                <div class="text-center items-center justify-center py-4">Oops!..  ไม่เจอพิซซ่าที่คุณค้นหากรุณาลองใหม่อีกครั้ง</div>
        <?php }?>



        <script>
                
                function calculatePrice(){
                    var fid = document.getElementById("fid");
                    // console.log('fid + " " + fid.value);
                    var sizeId = document.querySelectorAll('input[type="radio"].sizeId:checked')[0];
                    // console.log('sizeId' + " " + sizeId.value);
                    var curstId = document.getElementById("curstId");
                    // console.log('curstId' + " " + curstId.value);
                    return {fid , sizeId, curstId};
                }

                function sendRequest(data){
                    $.ajax({
                            url: './query/pizza_check_price.php',
                            method: 'GET',
                            data: { 
                                fid: data['fid'].value,
                                fsid: data['sizeId'].value,
                                fcid: data['curstId'].value
                            },
                            success: function(response) {   

                                var data = JSON.parse(response);
                                console.log(data);

                                const price_text = document.getElementById("price_total");
                                const description_text = document.getElementById("description");
                                const image = document.getElementById("image");  // Corrected variable name

                                // console.log(image);

                                price_text.textContent = data[2].total;
                                description_text.textContent = data[0].description;
                                image.src = data[0].image;  // Update image source
                            },
                            error: function() {
                                console.log("filter error");
                            }
                    });
                }

                function addItemToCart(data){
                    $.ajax({
                            url: './query/pizza_add_to_cart.php',
                            method: 'GET',
                            data: { 
                                fid: data['fid'].value,
                                fsid: data['sizeId'].value,
                                fcid: data['curstId'].value
                            },
                            success: function(response) {   
                                var data = JSON.parse(response);
                                console.log(data);

                                if(data.status == 200){
                                    Swal.fire(
                                        'สำเร็จ!',
                                        data.message,
                                        'success'
                                    )
                                }else{
                                    Swal.fire(
                                        'ไม่สำเร็จ!',
                                        'เพิ่มไม่สำเร็จเกิดปัญหาบางอย่าง',
                                        'error'
                                    )
                                }

                                setTimeout(() => {
                                    window.location.href = "my_cart.php";
                                }, 2500);


                            },
                            error: function(err) {
                                console.log(err);
                            }
                    });
                }

                $(document).ready(function(){

                    $(".sizeId").click( ()=> {
                        var data = calculatePrice();
                        sendRequest(data);
                    })
                    
                    $("#fid").change(()=> {
                        var data = calculatePrice();
                        sendRequest(data);
                    })

                    $("#curstId").change(()=> {
                        var data = calculatePrice();
                        sendRequest(data);
                    })

                    $("#add_to_cart").click(()=> {
                        var data = calculatePrice();
                        sendRequest(data);
                        addItemToCart(data);
                    })
                    
                });


        </script>

        <?php
            include_once('./utils/toggle_menu.php');
        ?>



    </body>
    
</body>
</html>