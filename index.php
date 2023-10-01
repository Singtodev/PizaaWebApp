
<?php 
    session_start();
    include_once('./utils/condb.php');
    include_once('./components/view/pizza_card_item.php');
    include_once('./components/view/navbar.php');
?>

<?php
    $title = "Pizza Project";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="./styles.css">

</head>
<body class="bg-gray-100 relative">

    <div class="toggle_menu shadow-lg z-20 top-0 right-0  transition-all duration-300 max-w-[20rem] min-w-[20rem] h-screen fixed bg-white px-4">
        <i class="toggle-menu-button cursor-pointer fa-solid fa-arrow-right text-2xl bg-white text-[#131921] p-2 rounded-md px-2 mx-2"></i>
            <div class="h-[80%]">
                <div class="flex flex-col gap-y-4 py-4 cursor-pointer">

                    <a href="./index.php">
                        <div class="rounded-md p-2 hover:bg-gray-200 bg-opacity-50 text-left">หน้าแรก</div>
                    </a>


                    <?php
                    
                    if(isset($_SESSION['user_data'])){ ?>
                    <div class="rounded-md p-2 hover:bg-gray-200 bg-opacity-50 text-left">ตระกร้าของฉัน</div>
                    <a href="./history.php">
                    <div class="rounded-md p-2 hover:bg-gray-200 bg-opacity-50 text-left">ประวัติรายการสั่งซื้อ</div>
                    </a>
                    <div class="rounded-md p-2 hover:bg-gray-200 bg-opacity-50 text-left">ตั้งค่าบัญชี</div>
                    
                    <?php } ?>

                </div>

            </div>
            <div class="h-[20%]">
            <?php
            if(isset($_SESSION['user_data'])){ ?>
                <div class="text-center mb-2"><?php echo $_SESSION['user_data']['name'] ?></div>
                <a href="./logout.php">
                    <div class="bg-red-500 text-white rounded-md p-2 text-center">Sign Out</div>
                </a>
            <?php } ?>
            </div>


    </div>

    <div class="mx-auto lg:w-full lg:mx-0">
                <?php
                    $navbarComponent = new NavbarComponent();
                    echo $navbarComponent->build();
                ?>
    </div>

    <div class="max-w-[80rem] lg:max-w-[110rem] mx-auto lg:py-14 mb-8">

        <div class="w-full h-[30rem] bg-gradient-to-r from-orange-500 lg:mb-14 py-10 px-10">
                <div class="text-5xl font-bold py-2 mb-5"> Buy to day</div>
                <div class="text-5xl font-bold py-2 mb-3"> FREE *</div>
                <div class="text-4xl font-bold py-2 mb-2"> Delivery</div>
                <div class="text-2xl py-3">32 march - 45 Oct   2077 only</div>
                <div class="text-md max-w-[25rem] py-3">This promotion is available in limited quantities, so hurry and buy quickly.  </div>
        </div>



        <div class="flex flex-col md:flex-row gap-x-3 p-5">
            <div class="w-full lg:w-[20%] bg-white px-5 inline-block lg:min-h-[40rem]">
                <div class="checkbox_group flex flex-col gap-x-4 my-4">
                    <p class="size">ขนาดไซด์</p>
                    <?php
                    
                    $sql = "SELECT  * from food_size";
                    $result = $condb->query($sql);
                    while($row = $result->fetch_assoc()) { ?>
                            <label class="flex gap-x-3">
                                <input  

                                    type="checkbox" 
                                    data-name="<?php echo $row['name'] ?>"
                                    class="cursor-pointer checkbox_trigger checkbox_size"> <?php echo $row['name'] ?></label>
                    <?php } ?>
                </div>

                <div class="checkbox_group flex flex-col gap-x-4 my-4">
                    <p class="size">ประเภท</p>
                    <?php
                    
                    $sql = "SELECT  * from food_type";
                    $result = $condb->query($sql);
                    while($row = $result->fetch_assoc()) { ?>
                            <label class="flex gap-x-3">
                                <input  
   
                                    type="checkbox" 
                                    data-name="<?php echo $row['name'] ?>"
                                    class="cursor-pointer checkbox_trigger checkbox_type"> <?php echo $row['name'] ?></label>
                    <?php } ?>
                </div>

                <div class="checkbox_group flex flex-col gap-x-4 my-4">
                    <p class="size">ขอบ</p>
                    <?php
                    
                    $sql = "SELECT  * from food_crust";
                    $result = $condb->query($sql);
                    while($row = $result->fetch_assoc()) { ?>
                            <label class="flex gap-x-3">
                                <input  

                                    type="checkbox" 
                                    data-name="<?php echo $row['name'] ?>"
                                    class="cursor-pointer checkbox_trigger checkbox_crust"> <?php echo $row['name'] ?></label>
                    <?php } ?>
                </div>



            </div>
            <div class="w-full lg:w-[80%]">
                <section id="section-pizza-show">
                    <div class="w-full grid grid-cols-1 md:grid-cols-2 md:gap-x-5 lg:grid-cols-4  lg:gap-x-10 gap-y-10">
                        <?php
                            $sql = "SELECT food.fid, food.description, (food.price + food_size.price + food_crust.price) as price, food.image,
                            food.name as f_name, food_type.name as f_type_name, food_size.name as f_size_name, food_crust.name as f_crust_name
                            FROM food
                            JOIN food_type ON food.ftid = food_type.ftid
                            JOIN food_size ON food.fsid = food_size.fsid
                            JOIN food_crust ON food.fcid = food_crust.fcid
                            ORDER BY food.fid";
                            
                        $result = $condb->query($sql);
                        while($row = $result->fetch_assoc()) { ?>

                                <?php
                                    $card = new PizzaCardItem();
                                    $card->build($row);
                                ?>

                        <?php } ?>
                    </div>
                </section>
            </div>
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