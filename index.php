
<?php 

    include_once('./utils/condb.php');
    include_once('./components/view/pizza_card_item.php');
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
</head>
<body class="bg-gray-100">
    <div class="mx-auto lg:w-full lg:mx-0">
        <div class="relative navbar w-full bg-[#131921] h-[4rem] flex items-center">
                <div class="hidden md:flex flex-row w-full">
                    <div class="w-[30%] lg:w-[20%] flex px-5">
                        <div class="relative flex flex-col w-[5rem] h-[2.4rem] mx-5 flex items-center justify-center text-xl text-white">
                            Piazzanician
                            <span class="text-[10px] absolute left-0 top-5">by cs msu</span>
                        </div>
                    </div>

                    <div class="w-[40%] lg:w-[60%]">
                        <div class="w-full h-full bg-white rounded-tl-lg rounded-md relative ">
                            <input type="text"  class="w-full h-full px-16 outline-none rounded-md" 
                            placeholder = "Search Pizza"
                            name="search" />
                            <div class="w-[3rem] h-full absolute left-0 top-0 flex items-center text-gray-500 justify-center bg-gray-300 rounded-tl-lg">All</div>
                            <div class="w-[5rem] cursor-pointer h-full absolute right-0 top-0 flex items-center justify-center text-gray-500 bg-orange-300">Search</div>
                        </div>
                    </div>

                    <div class="w-[30%] lg:w-[20%]">
                            <div class="relative flex items-center px-4 w-full h-full text-white">
                                    <i class="fa-solid fa-cart-shopping text-2xl"></i>
                                    <div class="absolute right-10 flex flex-row gap-x-5 items-center">
                                        <div class="cursor-pointer">Sign In</div>
                                        <i class="fa-solid fa-bars text-2xl"></i>
                                    </div>
                            </div>
                    </div>
  

                </div>
        </div>
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