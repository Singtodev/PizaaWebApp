

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
<body>
    <div class="mx-auto lg:w-full lg:mx-0">
        <div class="relative navbar w-full bg-[#131921] h-[4rem] flex items-center">
                <div class="hidden md:flex flex-row w-full">
                    <div class="w-[30%] lg:w-[20%] flex">
                        <div class="w-[5rem] h-[2.4rem] bg-white mx-5 flex items-center justify-center text-sm">LOGO</div>
                    </div>

                    <div class="w-[40%] lg:w-[60%]">
                        <div class="w-full h-full bg-white rounded-tl-lg rounded-md relative ">
                            <input type="text"  class="w-full h-full px-16 outline-none rounded-md" 
                            placeholder = "Search Pizza"
                            name="search" />
                            <div class="w-[3rem] h-full absolute left-0 top-0 flex items-center text-gray-500 justify-center bg-gray-300 rounded-tl-lg">All</div>
                            <div class="w-[5rem] cursor-pointer h-full absolute right-0 top-0 flex items-center justify-center bg-orange-300">Search</div>
                        </div>
                    </div>

                    <div class="w-[30%] lg:w-[20%]">
                            <div class="relative flex items-center px-4 w-full h-full text-white">
                                    <i class="fa-solid fa-cart-shopping text-2xl"></i>
                                    <div class="absolute right-10">
                                        <i class="fa-solid fa-bars text-2xl"></i>
                                    </div>
                            </div>
                    </div>
  

                </div>
        </div>
    </div>



</body>
</html>