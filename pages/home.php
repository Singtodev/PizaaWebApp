<?php
    require_once('../services/index.php');
    require_once('../components/index.php');
    
    $navbar = new Navbar(
        $isPageFolder,
        $userData
    );
?>
<!DOCTYPE html>
<html lang="en">
<?php
    require_once('../utils/head.php')
?>
<body>
    <div>
        <?php $navbar->build();?>

        <div class="w-full relative after:content-[''] after:absolute after:w-full after:h-[10px] after:bottom-0 after:h-[40px] after:blur-lg lg:hidden bg-gray-300 flex items-center h-[320px]  bg-cover bg-center object-cover bg-[url(https://plus.unsplash.com/premium_photo-1675451537771-0dd5b06b3985?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1887&q=80)]"" >
            <div class="absolute w-full h-full bg-black bg-opacity-30 bg-gradient-to-b from-transparent  to-black">..</div>
            <div class="relative w-full px-4 gap-y-5">
                <div class="text-white text-2xl font-bold">This is Pizza Destiny</div>
                <div class="text-white max-w-[300px]">The world’s best stovetop pizza maker cook perfect pizzeria style pizza every time in just 10 minutes.</div>
                <div class="text-white inline-block px-8 rounded-2xl py-[5px] my-6 bg-[#FF4D00]"> Buy Now</div>
            </div>
        </div>

        <div class="w-full relative lg:hidden h-[100px] bg-white flex items-center">
                <div class="w-full px-4 h-[40px] flex items-center justify-center flex-row gap-x-6">
                        <div class="w-[40px] h-full bg-cover bg-center object-cover bg-[url(https://upload.wikimedia.org/wikipedia/en/5/57/KFC_logo-image.svg)]"></div>
                        <div class="w-[40px] h-full bg-cover bg-center object-cover bg-[url(https://upload.wikimedia.org/wikipedia/commons/c/cc/Burger_King_2020.svg)]"></div>
                        <div class="w-[40px] h-full bg-cover bg-center object-cover bg-[url(https://www.stjegypt.com/uploads/503099209134.jpg)]"></div>
                        <div class="w-[40px] h-full bg-cover bg-center object-cover bg-[url(https://www.mkrestaurant.com/public/assets/img/icon/logo__mk.png)]"></div>
                        <div class="w-[40px] h-full bg-cover bg-center object-cover bg-[url(https://upload.wikimedia.org/wikipedia/commons/c/cb/SF_Cinema_logo.jpg)]"></div>
                </div>
        </div>

        <div class="w-full relative lg:hidden bg-white py-4">
                <div class="w-full flex items-center justify-center text-2xl font-bold mb-6">Pizza Chef is Easy to Use</div>
                <div class="services flex flex-row py-4 px-4 gap-x-6">
                        <div class="service relative w-[100px] flex flex-col ">
                                <div class="service_icon w-full h-[50px] z-10 mb-4">
                                    <div class="absolute z-40 w-[80px] h-[50px] rounded-[4rem] bg-gray-300"></div>
                                    <div class="absolute z-30 w-[80px] h-[50px] rounded-[4rem] bg-gray-200 left-8 top-3"></div>
                                    <div class="relative z-50 w-full h-full flex items-center justify-center text-4xl text-[#FF4D00]"><i class="fa-solid fa-pizza-slice"></i></div>
                                </div>
                                <div class="service_text w-full z-10">
                                    <div class="w-full flex items-center justify-center text-bold text-lg">Prep</div>
                                    <div class="text-gray-400 text-xs text-center">Your pizza goes directly on the tray. No stone required.</div>
                                </div>
                        </div>
                        <div class="service relative w-[100px] flex flex-col">
                                <div class="service_icon w-full h-[50px] z-10 mb-4">
                                    <div class="absolute z-40 w-[80px] h-[50px] rounded-[4rem] bg-gray-300"></div>
                                    <div class="absolute z-30 w-[80px] h-[50px] rounded-[4rem] bg-gray-200 left-8 top-3"></div>
                                    <div class="relative z-50 w-full h-full flex items-center justify-center text-4xl text-[#FF4D00]"><i class="fa-solid fa-timeline"></i></div>
                                </div>
                                <div class="service_text w-full z-10">
                                    <div class="w-full flex items-center justify-center text-bold text-lg">Insert</div>
                                    <div class="text-gray-400 text-xs text-center">Place the tray into the base skillet and secure it with the Heat Reflective Lid.</div>
                                </div>
                        </div>
                        <div class="service relative w-[100px] flex flex-col">
                                <div class="service_icon w-full h-[50px] z-10 mb-4">
                                    <div class="absolute z-40 w-[80px] h-[50px] rounded-[4rem] bg-gray-300"></div>
                                    <div class="absolute z-30 w-[80px] h-[50px] rounded-[4rem] bg-gray-200 left-8 top-3"></div>
                                    <div class="relative z-50 w-full h-full flex items-center justify-center text-4xl text-[#FF4D00]"><i class="fa-solid fa-clock"></i></div>
                                </div>
                                <div class="service_text w-full z-10">
                                    <div class="w-full flex items-center justify-center text-bold text-lg">Bake</div>
                                    <div class="text-gray-400 text-xs text-center">In 10 minutes you’ll have an evenly cooked pizza with your toppings melted in harmony.</div>
                                </div>
                        </div>
                        

                </div>
                <div class="services flex flex-row justify-center py-4 px-4 gap-x-10">
                        <div class="service relative w-[100px] flex flex-col ">
                                <div class="service_icon w-full h-[50px] z-10 mb-4">
                                    <div class="absolute z-40 w-[80px] h-[50px] rounded-[4rem] bg-gray-300"></div>
                                    <div class="absolute z-30 w-[80px] h-[50px] rounded-[4rem] bg-gray-200 left-8 top-3"></div>
                                    <div class="relative z-50 w-full h-full flex items-center justify-center text-4xl text-[#FF4D00]"><i class="fa-solid fa-truck"></i></div>
                                </div>
                                <div class="service_text w-full z-10">
                                    <div class="w-full flex items-center justify-center text-bold text-lg">Delivery</div>
                                    <div class="text-gray-400 text-xs text-center">Your pizza goes directly on the tray. No stone required.</div>
                                </div>
                        </div>
                        <div class="service relative w-[100px] flex flex-col ">
                                <div class="service_icon w-full h-[50px] z-10 mb-4">
                                    <div class="absolute z-40 w-[80px] h-[50px] rounded-[4rem] bg-gray-300"></div>
                                    <div class="absolute z-30 w-[80px] h-[50px] rounded-[4rem] bg-gray-200 left-8 top-3"></div>
                                    <div class="relative z-50 w-full h-full flex items-center justify-center text-4xl text-[#FF4D00]"><i class="fa-solid fa-money-bill"></i></div>
                                </div>
                                <div class="service_text w-full z-10">
                                    <div class="w-full flex items-center justify-center text-bold text-lg">Payment</div>
                                    <div class="text-gray-400 text-xs text-center">Place the tray into the base skillet and secure it with the Heat Reflective Lid.</div>
                                </div>
                        </div>
                </div>
        </div>

        <div class="w-full relative lg:hidden bg-white py-4">
                <div class="grid grid-cols-2 gap-x-4 px-4 h-[300px] p-2">
                    <div class="w-full h-full flex flex-row gap-x-3">
                        <div class="grid grid-rows-2 gap-y-4 w-full h-full">
                            <div class=" bg-cover bg-center object-cover bg-[url(https://images.unsplash.com/photo-1541745537411-b8046dc6d66c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1888&q=80)]"">.</div>
                            <div class=" bg-cover bg-center object-cover bg-[url(https://images.unsplash.com/photo-1544982503-9f984c14501a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1887&q=80)]"">.</div>
                        </div>
                        <div class="grid grid-rows-1 gap-y-4 w-full h-full">
                            <div class=" bg-cover bg-center object-cover bg-[url(https://images.unsplash.com/photo-1544982503-9f984c14501a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1887&q=80)]"">.</div>
                        </div>
                    </div>
                    <div class="w-full flex items-center flex-col justify-center gap-y-5">
                            <div class="w-full text-[#676363] font-bold">No pre-heating. Nothawing. No Waiting</div>
                            <div class="text-xs text-[#A9A9A9]">Making pizza the regular way is a pain. waiting for your oven to pre-heat. Then waiting for your pizza to bake. The pizza Chef cooker makes a perfect pizza top and bottom without the hassle.</div>
                            <div class="w-full flex flex-start ">
                                <div class="text-white inline-block px-8 rounded-2xl py-[2px] items-center text-sm   bg-[#FF4D00]"> Learn More</div>
                            </div>
                    </div>
                </div>
        </div>


        <div class="w-full relative lg:hidden bg-white py-4 pb-10">
            <div class="px-4 text-[#676363] text-md mb-6">What kind of pizza do you want to eat?</div>
            <div class="px-4 grid grid-cols-3 gap-x-2 gap-y-2">
                <div class="w-full h-[210px] p-1 bg-white rounded-md shadow-2xl">
                    <div class="w-full h-[80px] bg-cover bg-center object-cover bg-[url(https://images.unsplash.com/photo-1541745537411-b8046dc6d66c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1888&q=80)]""></div>
                    <div class="text-sm py-1 mt-1">Mushroom Pizza</div>
                    <div class="text-xs text-[#6D6D6D] mb-2">Goat cheese, best pizza dough, semolina flour, mozzarella</div>
                    <div class="flex flex-row justify-between">
                        <div class="text-sm">15 ฿</div>
                        <div class="text-xs bg-[#FF4D00] flex items-center text-white px-1 rounded-md">Add to cart</div>
                    </div>
                </div>
                <div class="w-full h-[210px] p-1 bg-white rounded-md shadow-2xl">
                    <div class="w-full h-[80px] bg-cover bg-center object-cover bg-[url(https://images.unsplash.com/photo-1541745537411-b8046dc6d66c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1888&q=80)]""></div>
                    <div class="text-sm py-1 mt-1">Mushroom Pizza</div>
                    <div class="text-xs text-[#6D6D6D] mb-2">Goat cheese, best pizza dough, semolina flour, mozzarella</div>
                    <div class="flex flex-row justify-between">
                        <div class="text-sm">15 ฿</div>
                        <div class="text-xs bg-[#FF4D00] flex items-center text-white px-1 rounded-md">Add to cart</div>
                    </div>
                </div>
                <div class="w-full h-[210px] p-1 bg-white rounded-md shadow-2xl">
                    <div class="w-full h-[80px] bg-cover bg-center object-cover bg-[url(https://images.unsplash.com/photo-1541745537411-b8046dc6d66c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1888&q=80)]""></div>
                    <div class="text-sm py-1 mt-1">Mushroom Pizza</div>
                    <div class="text-xs text-[#6D6D6D] mb-2">Goat cheese, best pizza dough, semolina flour, mozzarella</div>
                    <div class="flex flex-row justify-between">
                        <div class="text-sm">15 ฿</div>
                        <div class="text-xs bg-[#FF4D00] flex items-center text-white px-1 rounded-md">Add to cart</div>
                    </div>
                </div>
                <div class="w-full h-[210px] p-1 bg-white rounded-md shadow-2xl">
                    <div class="w-full h-[80px] bg-cover bg-center object-cover bg-[url(https://images.unsplash.com/photo-1541745537411-b8046dc6d66c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1888&q=80)]""></div>
                    <div class="text-sm py-1 mt-1">Mushroom Pizza</div>
                    <div class="text-xs text-[#6D6D6D] mb-2">Goat cheese, best pizza dough, semolina flour, mozzarella</div>
                    <div class="flex flex-row justify-between">
                        <div class="text-sm">15 ฿</div>
                        <div class="text-xs bg-[#FF4D00] flex items-center text-white px-1 rounded-md">Add to cart</div>
                    </div>
                </div>
                <div class="w-full h-[210px] p-1 bg-white rounded-md shadow-2xl">
                    <div class="w-full h-[80px] bg-cover bg-center object-cover bg-[url(https://images.unsplash.com/photo-1541745537411-b8046dc6d66c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1888&q=80)]""></div>
                    <div class="text-sm py-1 mt-1">Mushroom Pizza</div>
                    <div class="text-xs text-[#6D6D6D] mb-2">Goat cheese, best pizza dough, semolina flour, mozzarella</div>
                    <div class="flex flex-row justify-between">
                        <div class="text-sm">15 ฿</div>
                        <div class="text-xs bg-[#FF4D00] flex items-center text-white px-1 rounded-md">Add to cart</div>
                    </div>
                </div>
                <div class="w-full h-[210px] p-1 bg-white rounded-md shadow-2xl">
                    <div class="w-full h-[80px] bg-cover bg-center object-cover bg-[url(https://images.unsplash.com/photo-1541745537411-b8046dc6d66c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1888&q=80)]""></div>
                    <div class="text-sm py-1 mt-1">Mushroom Pizza</div>
                    <div class="text-xs text-[#6D6D6D] mb-2">Goat cheese, best pizza dough, semolina flour, mozzarella</div>
                    <div class="flex flex-row justify-between">
                        <div class="text-sm">15 ฿</div>
                        <div class="text-xs bg-[#FF4D00] flex items-center text-white px-1 rounded-md">Add to cart</div>
                    </div>
                </div>
                <div class="w-full h-[210px] p-1 bg-white rounded-md shadow-2xl">
                    <div class="w-full h-[80px] bg-cover bg-center object-cover bg-[url(https://images.unsplash.com/photo-1541745537411-b8046dc6d66c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1888&q=80)]""></div>
                    <div class="text-sm py-1 mt-1">Mushroom Pizza</div>
                    <div class="text-xs text-[#6D6D6D] mb-2">Goat cheese, best pizza dough, semolina flour, mozzarella</div>
                    <div class="flex flex-row justify-between">
                        <div class="text-sm">15 ฿</div>
                        <div class="text-xs bg-[#FF4D00] flex items-center text-white px-1 rounded-md">Add to cart</div>
                    </div>
                </div>
                <div class="w-full h-[210px] p-1 bg-white rounded-md shadow-2xl">
                    <div class="w-full h-[80px] bg-cover bg-center object-cover bg-[url(https://images.unsplash.com/photo-1541745537411-b8046dc6d66c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1888&q=80)]""></div>
                    <div class="text-sm py-1 mt-1">Mushroom Pizza</div>
                    <div class="text-xs text-[#6D6D6D] mb-2">Goat cheese, best pizza dough, semolina flour, mozzarella</div>
                    <div class="flex flex-row justify-between">
                        <div class="text-sm">15 ฿</div>
                        <div class="text-xs bg-[#FF4D00] flex items-center text-white px-1 rounded-md">Add to cart</div>
                    </div>
                </div>
                <div class="w-full h-[210px] p-1 bg-white rounded-md shadow-2xl">
                    <div class="w-full h-[80px] bg-cover bg-center object-cover bg-[url(https://images.unsplash.com/photo-1541745537411-b8046dc6d66c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1888&q=80)]""></div>
                    <div class="text-sm py-1 mt-1">Mushroom Pizza</div>
                    <div class="text-xs text-[#6D6D6D] mb-2">Goat cheese, best pizza dough, semolina flour, mozzarella</div>
                    <div class="flex flex-row justify-between">
                        <div class="text-sm">15 ฿</div>
                        <div class="text-xs bg-[#FF4D00] flex items-center text-white px-1 rounded-md">Add to cart</div>
                    </div>
                </div>
                
            </div>
            <div class="px-4 text-[#676363] text-md mb-6 text-right py-4">Showing more...</div>
        </div>

        <div class="w-full relative lg:hidden bg-black py-4 h-[200px]">
                <div class="px-4 text-[#676363] text-md">PizzaShop</div>
                <div class="px-4 text-[#676363] text-md mb-6 pb-2">Mahasarakham University</div>
 
                <div class="grid grid-cols-3 gap-x-2 px-4">
  
                    <div class="relative text-white flex flex-col gap-y-2">
                            <div class="text-sm text-white">Made by</div>
                            <div class="text-xs">1 ) Singharat bunphim</div>
                            <div class="text-xs">2 ) Prachaya Laosri</div>
                    </div>

                    <div class="relative text-white flex flex-col gap-y-2">
                            <div class="text-sm text-white">&nbsp;</div>
                            <div class="text-xs">singharatbunphim@gmail.com</div>
                            <div class="text-xs">Prachaya Laosri</div>
                    </div>
                </div>
        </div>


    </div>


</body>
</html>