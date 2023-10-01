<?php


        class NavbarComponent {
            public function __construct() {}

            public function build() {
                return '
                    <div class="relative navbar w-full bg-[#131921] h-[4rem] flex items-center">
                        <div class="hidden md:flex flex-row w-full">
                            <div class="w-[30%] lg:w-[20%] flex px-5">
                                <div class="relative flex flex-col w-[5rem] h-[2.4rem] mx-5 flex items-center justify-center text-xl text-white">
                                    Pizzanician
                                    <span class="text-[10px] absolute left-0 top-5">by cs msu</span>
                                </div>
                            </div>
                            <div class="w-[40%] lg:w-[60%]">
                                <div class="w-full h-full bg-white rounded-tl-lg rounded-md relative">
                                    <input type="text" class="w-full h-full px-16 outline-none rounded-md" placeholder="Search Pizza" name="search" />
                                    <div class="w-[3rem] h-full absolute left-0 top-0 flex items-center text-gray-500 justify-center bg-gray-300 rounded-tl-lg">All</div>
                                    <div class="w-[5rem] cursor-pointer h-full absolute right-0 top-0 flex items-center justify-center text-gray-500 bg-orange-300">Search</div>
                                </div>
                            </div>
                            <div class="w-[30%] lg:w-[20%]">
                                <div class="relative flex items-center px-4 w-full h-full text-white">
                                    <i class="fa-solid fa-cart-shopping text-2xl"></i>
                                    <div class="absolute right-10 flex flex-row gap-x-5 items-center">
                                        ' . (!isset($_SESSION['user_data']) ? '<a href="./login.php"><div class="cursor-pointer">Sign In</div></a>' : '') . '
                                        ' . (isset($_SESSION['user_data']) ? '<div>' . $_SESSION['user_data']['name'] . '</div><div class="w-[2.2rem] h-[2.2rem] rounded-full bg-cover object-cover bg-center bg-no-repeat bg-[url(\'' . $_SESSION['user_data']['photo'] . '\')]"></div>' : '') . '
                                        <i class="toggle-menu-button fa-solid cursor-pointer fa-bars text-2xl"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            }
}