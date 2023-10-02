
<?php 
    session_start();
    include_once('./utils/condb.php');
    include_once('./components/view/pizza_card_item.php');
    include_once('./components/view/navbar.php');
    include_once('./components/view/sidebar.php');
?>

<?php
    $title = "Pizza Project";
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
                    $cartItems = $navbarComponent->getCartItem();
                    $sumTotal = $navbarComponent->getCartItemTotal();
                ?>
    </div>

    <div class="max-w-[80rem] lg:max-w-[110rem] mx-auto lg:py-14 mb-8">

                <div class="max-w-[72rem] mx-auto min-h-[30rem] bg-gradient-to-r from-[#131921] lg:mb-14 py-10 px-10">
                        <div class="text-3xl text-white">ตระกร้าสินค้าของฉัน <?php echo count($cartItems) == 0 ? '(ไม่มีสินค้าในตระกร้า)' : 'false' ?></div>
                        <div class="grid grid-cols-3 gap-4 py-2">
                        <?php
                                foreach($cartItems as $item) { ?>
                
                                        <div class="w-full min-h-[20rem] hover:scale-105 bg-gray-100 rounded-md transition-all duration-300 flex flex-col ">
             
                                                <div class="bg-[url('<?= $item['image'] ?>')] h-[14rem] w-full object-cover bg-cover  bg-no-repeat"></div>


                                                <div class="py-2 font-bold w-full flex items-center justify-center">
                                                    <div class="w-[20rem]">
                                                        <div class="name"><?= $item['name'] ?></div>
                                                        <div class="size_name">Pizza Size : <?= $item['size_name'] ?></div>   
                                                        <div class="quantity">Quantity : <?= $item['quantity'] ?></div>   
                                                        <div class="price">Total : <?= $item['total'] ?> THB </div>  
                                                    </div>

                                                </div>
                   
                                        </div>
    
                                <?php } ?>
                         </div>

                         <?php

                            if(count($cartItems) > 0){ ?>
                                <div class="text-white text-xl my-6"> เลือกช่องทางชำระเงิน</div>
                                <div class="grid grid-cols-2 gap-2 mt-6">
                                       <div class="border border-gray-300 text-xl py-4 text-center bg-gray-200 rounded-md hover:border-black cursor-pointer border-2">จ่ายแบบเงินสด (Cash)</div>
                                       <div class="border border-gray-300 text-xl py-4 text-center bg-gray-200 rounded-md hover:border-black cursor-pointer border-2">จ่ายแบบสแกน (QR Code)</div>
                                </div>
                               
                               <div class="flex flex-col gap-2 mt-6">
                                   <div class="text-white text-xl"> ราคารวมทั้งหมด <?php echo $sumTotal ?> THB</div>
                                   <div class="bg-lime-500 text-white w-full max-w-[30rem] hover:bg-opacity-50 transition-all duration-300 py-1 rounded-md px-2 cursor-pointer text-center">ชำระเงิน</div>
                               </div>
                            <?php } ?>


                        ?>



                </div>




    </div>
    



    <script>


            function getAllValueInCheckBoxSize(hook){
                var x = document
                .querySelectorAll(hook);

                var active = [];
                var all_keys = [];
                for(let i = 0; i < x.length; i++){
                    if(x[i].checked){
                        active.push(x[i].attributes['data-name'].value)
                    }

                    all_keys.push(x[i].attributes['data-name'].value)
                }
                return {active , all_keys};
            }


            $(document).ready(function(){

                
                $('.toggle-menu-button').click(function(){
                    var dom = document.getElementsByClassName("toggle_menu")[0];
                    dom.classList.toggle("active");
                })


                $(".checkbox_trigger").click(function(){

                    var QuerySizes = getAllValueInCheckBoxSize(".checkbox_size");
                    var QueryTypes = getAllValueInCheckBoxSize(".checkbox_type");
                    var QueryCrusts = getAllValueInCheckBoxSize(".checkbox_crust");

                    $.ajax({
                        url: './query/pizza_data.php',
                        method: 'GET',
                        data: { 
                            sizes : QuerySizes.active.length > 0 ? QuerySizes.active : QuerySizes.all_keys,
                            types:  QueryTypes.active.length > 0 ? QueryTypes.active : QueryTypes.all_keys,
                            crusts:  QueryCrusts.active.length > 0 ? QueryCrusts.active : QueryCrusts.all_keys
                        },
                        success: function(response) {   
                            $('#section-pizza-show').html(response);
                        },
                        error: function() {
                            console.log("filter error");
                        }
                    });

                });
            });

    </script>


</body>
</html>