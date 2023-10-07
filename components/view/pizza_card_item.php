<?php
    

class PizzaCardItem {

    public function __construct() {

    }

    public function build($row) {
        // Echo the HTML markup
        echo '<div class="relative bg-white border-4 border-white rounded-md hover:border-[#131921] transition-all duration-300">';
        echo '<div class="card w-full h-[8rem] md:h-[8rem] lg:h-[12rem] cursor-pointer bg-gray-300 bg-contain object-cover bg-center bg-no-repeat" style="background-image: url(\'' . $row['image'] . '\')"></div>';
        echo '<div class="content p-2">';
        echo '<div class="header">';
        echo '<div class="title text-bold text-xl">' . $row['f_name'] . '</div>';
        echo '</div>';
        echo '<div class="body pt-3">';
        echo '<div class="description text-bold text-xl min-h-[5rem]">';
        if (strlen($row['description']) > 170) {
            echo substr($row['description'], 0, 260) . '...';
        } else {
            echo $row['description'];
        }
        echo '</div>';
        echo '</div>';
            echo '<div class="py-2 flex flex-row justify-between">';
                echo '<div class="flex items-center flex-row gap-x-4">';
                        echo '<div><span class="text-red-700">' . $row['price'] . '</span> THB </div>';
                        echo '<div class="badge">';
                        echo '</div>';
                echo '</div>';
                if (isset($_SESSION['user_data']) && $_SESSION['user_data']['role'] !=  '2' ) {
                echo '<div class="items-center gap-x-3 hidden lg:flex">';
                    echo '<a href="add_pizza.php?f_id=' . $row['fid'] . '"><i class="fa-solid cursor-pointer fa-plus inline-block bg-green-500 text-white px-2 rounded-full hover:bg-opacity-50 transition-all duration-300 text-2xl text-white"></i></a>';
                    echo '<a href="show.php?f_id=' . $row['fid'] . '"><i class="fa-solid fa-search inline-block text-green-500 text-2xl"></i></a>';
                echo '</div>';
                }
                
            echo '</div>';
            echo '<span class="text-xs">Includes <span class="bg-yellow-200 px-2 rounded-md mx-1">'.$row['f_size_name']. ' </span> +  <span class="bg-yellow-200 px-2 rounded-md mx-1">'. $row['f_crust_name']. '</span></span>';
        echo '</div></div>';
    }
}

?>






