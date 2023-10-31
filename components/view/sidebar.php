<?php
class SidebarComponent {
    function build() {
        echo '<i class="toggle-menu-button cursor-pointer fa-solid fa-arrow-right text-2xl bg-white text-[#131921] p-2 rounded-md px-2 mx-2"></i>';
        echo '<div class="h-[80%]">';
        echo '<div class="flex flex-col gap-y-4 py-4 cursor-pointer">';

        echo '<a href="./index.php">';
        echo '<div class="rounded-md p-2 hover:bg-gray-200 bg-opacity-50 text-left">หน้าแรก</div>';
        echo '</a>';

        if (isset($_SESSION['user_data']) && $_SESSION['user_data']['role'] !=  '2' ) {
            echo '<a href="./my_cart.php">';
            echo '<div class="rounded-md p-2 hover:bg-gray-200 bg-opacity-50 text-left">ตระกร้าของฉัน</div>';
            echo '</a>';
            echo '<a href="./history.php">';
            echo '<div class="rounded-md p-2 hover:bg-gray-200 bg-opacity-50 text-left">ประวัติรายการสั่งซื้อ</div>';
            echo '</a>';
            // echo '<div class="rounded-md p-2 hover-bg-gray-200 bg-opacity-50 text-left">ตั้งค่าบัญชี</div>';
        }

        if(isset($_SESSION['user_data']) && $_SESSION['user_data']['role'] == '2'){
            echo '<a href="./admin.php">';
            echo '<div class="rounded-md p-2 hover:bg-gray-200 bg-opacity-50 text-left">หน้าผู้ดูแล</div>';
            echo '</a>';
        }

        echo '</div>';
        echo '</div>';

        if (isset($_SESSION['user_data'])) {
            echo '<div class="h-[20%]">';
            echo '<div class="text-center mb-2">'. $_SESSION['user_data']['name'] . '</div>';
            echo '<div class="text-center mb-2 text-xs">'.'('. $_SESSION['user_data']['email'] .')'. '</div>';
            echo '<a href="./logout.php">';
            echo '<div class="bg-red-500 text-white rounded-md p-2 text-center">Sign Out</div>';
            echo '</a>';
            echo '</div>';
        }
    }
}
?>