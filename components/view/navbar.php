<?php

class NavbarComponent {

    public $condb;
    public $cartItemCount = 0;
    public $cartItems = [];
    public $cartItemsSumTotal = 0;

    public function __construct($condb) {
        $this->condb = $condb;
        $this->queryOrderItems();
    }

    public function queryOrderItems() {
        if (isset($_SESSION['user_data']) && $_SESSION['user_data']['role'] != 2) {
            $uid = $_SESSION['user_data']['uid'];
            $sql = "SELECT * FROM iorder WHERE uid = ? AND status = 1";
            $stmt = $this->condb->prepare($sql);
            $stmt->bind_param('s', $uid);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    $this->queryCountItem($row);
                    $this->queryItemCart($row);
                    $this->querySumTotal($row);
                }
            }
        }
        return null;
    }

    public function queryCountItem($data) {
        $sql = "SELECT count(oid) as total FROM order_amount WHERE oid = ?";
        $stmt = $this->condb->prepare($sql);
        $stmt->bind_param('i', $data['oid']);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $this->cartItemCount = $row['total'];
            }
        }
        return null;
    }

    public function queryItemCart($data) {
            $sql = "SELECT oid,food.name, food.image as image, food_size.name as size_name ,food_crust.name as crust_name ,order_amount.amount as quantity ,((food_type.price + food_crust.price + food_size.price) * order_amount.amount) as total
            FROM  order_amount ,food, food_crust ,food_size , food_type
            WHERE order_amount.fid = food.fid
            AND   food.ftid = food_type.ftid
            AND   order_amount.fcid = food_crust.fcid
            AND   order_amount.fsid = food_size.fsid
            AND   order_amount.oid = ?
            order by odid DESC
            ";
        $stmt = $this->condb->prepare($sql);
        $stmt->bind_param('i', $data['oid']);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $arr = array();
                while($row = $result->fetch_assoc()){
                    array_push($arr,$row);
                }
                $this->cartItems = $arr;
            }
        }
        return null;
    }

    public function querySumTotal($data){
        $sql = "SELECT sum((food_type.price + food_crust.price + food_size.price) * order_amount.amount) as total
        FROM  order_amount,food,food_crust,food_size,food_type
        WHERE order_amount.fid = food.fid
        AND   food.ftid = food_type.ftid
        AND   order_amount.fcid = food_crust.fcid
        AND   order_amount.fsid = food_size.fsid
        AND   order_amount.oid = ?
        ";
        $stmt = $this->condb->prepare($sql);
        $stmt->bind_param('i', $data['oid']);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $this->cartItemsSumTotal = $row['total'];
            }
        }
        return null;
    }

    public function getCartItem(){
        return $this->cartItems;
    }

    public function getCartItemTotal(){
        return $this->cartItemsSumTotal;
    }

    public function build() {
        return '
            <div class="relative navbar w-full bg-[#131921] h-[4rem] flex items-center">
                <div class="hidden md:flex flex-row w-full">
                    <div class="w-[30%] lg:w-[20%] flex px-5">
                    <a href="index.php" class="cursor-pointer">
                        <div class="relative flex flex-col w-[5rem] h-[2.4rem] mx-5 flex items-center justify-center text-xl text-white">
                            Pizzanician
                            <span class="text-[10px] absolute left-0 top-5">by cs msu</span>
                        </div>
                </a>
                    </div>
                    <div class="w-[40%] lg:w-[60%]">
                        <div class="w-full h-full bg-white rounded-tl-lg rounded-md relative">
                            <input type="text" class="w-full h-full px-16 outline-none rounded-md" placeholder="Search Pizza" name="search" />
                            <div class="w-[3rem] h-full absolute left-0 top-0 flex items-center text-gray-500 justify-center bg-gray-300 rounded-tl-lg">All</div>
                            <div class="w-[5rem] cursor-pointer h-full absolute right-0 top-0 flex items-center justify-center text-gray-500 bg-orange-300 text-white">Search</div>
                        </div>
                    </div>
                    <div class="w-[30%] lg:w-[20%]">
                        <div class="relative flex items-center px-4 w-full h-full text-white">
                            <div class="relative">
                                ' . (isset($_SESSION['user_data']) && isset($_SESSION['user_data']['role']) && $_SESSION['user_data']['role'] != 2 ? '
                                    <a href="my_cart.php">
                                        <i class="fa-solid fa-cart-shopping text-2xl cursor-pointer"></i>' . ($this->cartItemCount > 0 ? '<span class="absolute bg-red-600 rounded-full w-5 h-5 -right-2 flex items-center justify-center items-center -top-1">' . $this->cartItemCount . '</span>' : '') . '
                                    </a>
                                ' : '') . '
                            </div>
                            <div class="absolute right-10 flex flex-row gap-x-5 items-center">
                                ' . (!isset($_SESSION['user_data']) ? '<a href="./login.php"><div class="cursor-pointer">Sign In</div></a>' : '') . '
                                ' . (isset($_SESSION['user_data']) ? '<div>' . $_SESSION['user_data']['name'] . '</div><div class="w-[2.2rem] h-[2.2rem] rounded-full bg-cover object-cover bg-center bg-no-repeat" style="background-image: url(\'' . $_SESSION['user_data']['photo'] . '\');"></div>' : '') . '
                                <i class="toggle-menu-button fa-solid cursor-pointer fa-bars text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ';
    }
    
}

?>