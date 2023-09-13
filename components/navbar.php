<?php

    class Navbar {

        private $isPageFolder;
        private $userData;

        public function __construct($isPageFolder , $userData){
            $this->isPageFolder = $isPageFolder;
            $this->userData = $userData;
        }
    

        public function build() {
            echo '<div class="relative navbar bg-white h-[60px] md:h-[80px] transition-all duration-300 flex items-center justify-between">';
                echo '<div class="logo w-[40px] rounded-xl h-[40px] mx-5 bg-cover bg-center object-cover bg-[url(https://img.freepik.com/premium-vector/pizza-logo-design_9845-319.jpg?w=826)]"></div>';
                echo '<div class="menu flex flex-row ml-5 px-3 gap-x-4 p-2 flex items-center">';


                    if($this->userData['data']['m_avatar']){
                        echo '<div class="avatar w-[30px] h-[30px] bg-gray-300 rounded-full bg-cover bg-center object-cover" style="background-image: url(' . $this->userData['data']['m_avatar'] . ');"></div>';
                    }else{
                        echo '<div class="avatar w-[30px] h-[30px] bg-gray-300 rounded-full"></div>';
                    }

                    echo '<div class="shopping_cart text-2xl relative">';

                    if($this->userData['shopping_cart'] && count($this->userData['shopping_cart']) > 0){
                        echo '<div class="bade absolute top-0 right-0 rounded-full bg-red-700 w-[12px] h-[12px] text-[10px] flex items-center justify-center text-white">'.count($this->userData['shopping_cart']).'</div>';
                    }
                    
                    echo '<i class="fa-solid fa-cart-shopping"></i>';
                    echo '</div>';
                    echo '<div class="menu_bar text-2xl"><i class="fa-solid fa-bars"></i></div>';
                echo '</div>';
            echo '</div>';
        }
    }

?>