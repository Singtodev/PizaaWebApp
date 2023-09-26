
<?php 

    include_once('./utils/condb.php');
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

    <div class="max-w-[80rem] lg:max-w-[110rem] mx-auto py-14">

        <div class="w-full h-[30rem] bg-gradient-to-r from-orange-500 mb-14 py-10 px-10">
                <div class="text-5xl font-bold py-2 mb-5"> Buy to day</div>
                <div class="text-5xl font-bold py-2 mb-3"> FREE *</div>
                <div class="text-4xl font-bold py-2 mb-2"> Delivery</div>
                <div class="text-2xl py-3">32 march - 45 Oct   2077 only</div>
                <div class="text-md max-w-[25rem] py-3">This promotion is available in limited quantities, so hurry and buy quickly.  </div>
        </div>
        <div class="grid grid-cols-4 gap-x-10 gap-y-10 cursor-pointer">
            <?php
            $sql = "SELECT * FROM food , food_type , food_size where food.f_type_id = food_type.f_type_id and food.f_size_id = food_size.f_size_id order by food.f_id";
            $result = $condb->query($sql);

            while($row = $result->fetch_assoc()) { ?>
                    
     
                        <div class="relative bg-white border-4 border-white  rounded-md  hover:border-[#131921] transition-all duration-300">
                            <div class="card w-full h-[24rem] cursor-pointer bg-gray-300 bg-cover object-cover bg-center " style="background-image: url('<?= $row['f_image'] ?>')">
                            </div>
                            <div class="content p-2">
                                <div class="header">
                                    <div class="title text-bold text-xl"><?= $row['f_name'] ?></div>
                                </div>
                                <div class="body pt-3">
                                </div>
                                <div class="footer py-3 flex flex-row justify-between">
                                    <div class="flex flex-row gap-x-4">
                                        <div><span class="text-red-700"><?= $row['f_price'] ?></span> THB </div>
                                        <div class="size"> <span class="bg-[#131921]  px-4 text-white rounded-2xl">Size  <?= strtoupper($row['f_size_name'] ) ?></span></div>
                                    </div>
    
                                    <div class="flex items-center gap-x-3"> 
                                        <i class="fa-solid fa-plus inline-block text-green-500  text-2xl"></i>
                                        <a href="show.php?f_id=<?php echo $row['f_id']?>">
                                            <i class="fa-solid fa-search inline-block text-green-500  text-2xl"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
          

            <?php } ?>
        </div>
    </div>



</body>
</html>