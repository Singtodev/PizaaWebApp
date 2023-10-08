
<?php 
    session_start();
    include_once('./utils/condb.php');
    include_once('./components/view/pizza_card_item.php');
    include_once('./components/view/navbar.php');
    include_once('./components/view/sidebar.php');
?>

<?php
    $title = "Pizza Project";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="./styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body class="bg-gray-100 relative">

    <div class="toggle_menu shadow-lg z-20 top-0 right-0  transition-all duration-300 max-w-[20rem] min-w-[20rem] h-screen fixed bg-white px-4">
                <?php
                    $sidebarComponent = new SidebarComponent();
                    echo $sidebarComponent->build();
                ?>
    </div>

    <div class="mx-auto lg:w-full lg:mx-0">
                <?php
                    $navbarComponent = new NavbarComponent($condb);
                    echo $navbarComponent->build();
                    $cartItems = $navbarComponent->getCartItem();
                    $sumTotal = $navbarComponent->getCartItemTotal();
                ?>
    </div>

    <div class="max-w-[80rem] lg:max-w-[110rem] mx-auto lg:py-14 mb-8">

                <div class="max-w-[72rem] mx-auto min-h-[30rem] bg-gradient-to-r from-[#131921] lg:mb-14 py-10 px-10">
                        <div class="text-3xl text-white">ตระกร้าสินค้าของฉัน <?php echo count($cartItems) == 0 ? '(ไม่มีสินค้าในตระกร้า)' : '' ?></div>
                        <div class="grid grid-cols-3 gap-x-3">

                            <div class="col-span-2 grid grid-cols-3 gap-4 py-2">
                                    <?php

                                        $sizes = array();
                                        $crusts = array();

                                        $sql = "SELECT * FROM food_size";
                                        $result = $condb->query($sql);

                                        while($row = $result->fetch_assoc()){
                                            array_push($sizes , $row);
                                        }         
                                        
                                        $sql = "SELECT * FROM food_crust";
                                        $result = $condb->query($sql);

                                        while($row = $result->fetch_assoc()){
                                            array_push($crusts , $row);
                                        }         
                                    ?>
                                    <?php
                                        foreach($cartItems as $item) { ?>
                        
                                                <div class="w-full h-[25rem] hover:scale-105 bg-gray-100 rounded-md transition-all duration-300 flex flex-col ">
                                                        <div class="rounded-t-lg bg-[url('<?= $item['image'] ?>')] h-[14rem] w-full object-cover bg-cover bg-center  bg-no-repeat"></div>
                                                        <div class="py-2 font-bold w-full flex items-center justify-center">
                                                            <div class="w-[20rem] p-2">
                                                                <div class="name"><?= $item['name'] ?></div>


                                                                <div class="size">
                                                                    ขนาดพิซซ่า : 
                                                                    <select id="<?= $item['odid']?>" class="sizeItem">
                                                                        <?php
                                                                            foreach($sizes as $size){ ?>
                                                                                <option <?php echo ($size['fsid'] == $item['o_fsid']) ? 'selected' : '' ?>  value="<?php echo $size['fsid']?>"><?php echo $size['name'] ?></option>
                                                                            <?php } ?>
                                                                        
                                                                    </select>
                                                                </div>   


                                                                <div class="crust">
                                                                    ขอบพิซซ่า : 
                                                                    <select id="<?= $item['odid']?>" class="crustItem">
                                                                        <?php
                                                                            foreach($crusts as $crust){ ?>
                                                                                <option <?php echo ($crust['fcid'] == $item['o_fcid']) ? 'selected' : '' ?>  value="<?php echo $crust['fcid']?>"><?php echo $crust['name'] ?></option>
                                                                            <?php } ?>
                                                                    </select>
                                                                </div>   



                                                                <div class="quantity flex flex-row gap-x-2">
                                                                    จำนวน : 
                                                                    <div value="<?= $item['odid'] ?>" class=" decreaseItem bg-gray-200 px-2 rounded-md cursor-pointer"> - </div>
                                                                        <?= $item['quantity'] ?>
                                                                    <div value="<?= $item['odid'] ?>" class=" increaseItem bg-gray-200 px-2 rounded-md cursor-pointer"> + </div>
                                                                </div>   
                                                                <div class="price">ราคา : <?= $item['total'] ?> THB</div>  
                                                                <div value="<?= $item['odid'] ?>" class="removeItem w-full py-2 bg-red-500 text-center  text-white mt-2 rounded-md cursor-pointer">ลบ</div>
                                                            </div>
                                                        </div>
                        
                                                </div>
            
                                        <?php } ?>
                            </div>

   
                                <?php
                                if(count($cartItems) > 0){ ?>
                               <div class="bg-white rounded-md">
                                    <div class="flex flex-col gap-2 mt-6 p-2">


                                        <div class="text-center text-xl font-bold pb-6">ข้อมูลการจัดส่ง</div>

                                        <div class="my-2 flex flex-col gap-y-2">

                                        <?php
                                        
                                            if($_SESSION['user_data']){ ?>

                                            <div class="text-md text-black  border rounded-md border-gray-200 grid grid-cols-3">
                                                <div class="bg-gray-100 text-center">ชื่อผู้รับ</div>
                                                <input
                                                    id="recipient_name"
                                                    value="<?= $_SESSION['user_data']['name'] ?>"
                                                    type="text" 
                                                    name="recipient_name"
                                                    placeholder="ระบุชื่้อผู้รับ"
                                                    class="w-full outline-none col-span-2 px-1">
                                            </div>
                                            <div class="text-md text-black  border rounded-md border-gray-200 grid grid-cols-3">
                                                <div class="bg-gray-100 text-center">เบอร์โทรศัพท์</div>
                                                <input 
                                                    id="recipient_phone"
                                                    value="<?= $_SESSION['user_data']['phone'] ?>"
                                                    type="text" 
                                                    min="0"
                                                    max="10"
                                                    name="recipient_phone" 
                                                    placeholder="ระบุเบอร์โทรศัพทย์ผู้รับ"
                                                    class="w-full outline-none col-span-2 px-1">
                                            </div>
                                            <div class="text-md text-black  border rounded-md border-gray-200 grid grid-cols-3">
                                                <div class="bg-gray-100 text-center">ที่อยู่จัดส่ง</div>
                                                <input
                                                    id="recipient_address"
                                                    value="<?= $_SESSION['user_data']['address'] ?>"
                                                    type="text" 
                                                    name="recipient_address" 
                                                    placeholder="ระบุที่อยู่การจัดส่ง"
                                                    class="w-full outline-none col-span-2 px-1">
                                            </div>

                                            <?php } ?>



                                        </div>


                                        <div class="text-center text-xl font-bold pb-6">สรุปรายการอาหาร</div>
                                        <?php
                                            foreach($cartItems as $item) { ?>
                                                <div class="grid grid-cols-3 px-4 text-xs text-gray-400  border-b-2 py-1">
                                                    <div class="col-span-2"> * <?php echo $item['name'] ?></div>
                                                    <div>  x <?php echo $item['quantity'] ?>  ( <?php echo $item['total'] ?>) THB</div>
                                                </div>
                                        <?php } ?>



                                        <div class="my-2">
                                                <div class="text-md text-center text-black py-2 ">เลือกช่องทางชำระเงิน</div>
                                                <div class="flex flex-row justify-center gap-x-2 py-2">
                                                    <input type="radio" selected="false" name="payment" id="Cash" class="payment px-2 border-2 rounded-md cursor-pointer">Cash</input>
                                                    <input type="radio" selected="false" name="payment" id="QR Code" class="payment px-2 border-2 rounded-md cursor-pointer">QR Code</input>
                                                </div>
                                        </div>                            

                                        <div class="my-2 ">
                                            <div class="text-md text-center text-black">สินค้าจำนวน ( <span class="text-lg"><?php echo count($cartItems) ?></span> ) รายการ</div>
                                            <div class="text-md text-center text-black"> ราคารวมทั้งหมด <span class="text-lg"><?php echo $sumTotal ?></span> THB</div>
                                            <div class="payment_submit mt-4 bg-lime-500 text-white w-full max-w-[30rem] hover:bg-opacity-50 transition-all duration-300 py-1 rounded-md px-2 cursor-pointer text-center">ชำระเงิน</div>
                                        </div>

                                    </div>
                               </div>
                                <?php } ?>


                        </div>





                        </div>




    </div>
    



    <script>
            
            var oid = <?php echo $navbarComponent->getOid(); ?>

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

            function removeItemById(odid){
                $.ajax({
                        url: './query/pizza_remove.php',
                        method: 'GET',
                        data: { 
                            odid : odid
                        },
                        success: function(response) {   
                            var data = JSON.parse(response);
                                if(data.status == 200){
                                    Swal.fire(
                                        'สำเร็จ!',
                                        'คุณลบสินค้าในตระกร้าเรียบร้อย!',
                                        'success'
                                    )
                                }else{
                                    Swal.fire(
                                        'ไม่สำเร็จ!',
                                        'ลบสินค้าไม่สำเร็จเกิดปัญหาบางอย่าง',
                                        'error'
                                    )
                                }
                                setTimeout(() => {
                                    window.location.reload();
                                }, 500);
                        },
                        error: function() {
                            console.log("remove item error");
                        }
                });
            }


            function updateItemById( odid , method, size = "0" , crust = "0" ){
                $.ajax({
                        url: './query/pizza_update.php',
                        method: 'GET',
                        data: { 
                            odid : odid,
                            method: method,
                            size: size,
                            crust: crust
                        },
                        success: function(response) {   
                            var data = JSON.parse(response);

                            console.log(data);
                               // error handle
                                if(data.status == 400){
                                    Swal.fire(
                                        'ไม่สำเร็จ!',
                                        data.message,
                                        'error'
                                    )
                                }

                               // warning item count <= 0 show this

                                if(data.status == 401){
                                    Swal.fire({
                                    title: 'ไม่สำเร็จ',
                                    text: data.message,
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#131921',
                                    cancelButtonColor: '#d33',
                                    cancelButtonText: 'ยกเลิก',
                                    confirmButtonText: 'ใช่ลบสินค้าเลย'
                                    }).then(async (result) => {
                                        if (result.isConfirmed) {
                                            await removeItemById(odid);
                                        }
                                    })
                                }
                                
                              // reload page condition 
                                if(data.status != 401){
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 500);
                                }

                        },
                        error: function() {
                            console.log("update item error");
                        }
                });
            }


            function getMethodPayment () {
                var allPaymentChoice = document.querySelectorAll('.payment');
                var result = null;
                for(let i = 0 ; i < allPaymentChoice.length; i++ ){

                    if(allPaymentChoice[i].attributes.selected.value == "true"){
                        result = allPaymentChoice[i].attributes.id.value;
                    }
                }

                return result;
            }

            $(document).ready(function(){
                
                $('.payment_submit').click(async (e)=> {
                    var method = await getMethodPayment();

                    if(method == null){
                        Swal.fire(
                            'ไม่สำเร็จ!',
                            'กรุณาเลือกช่องทางชำระเงิน',
                            'error'
                        )
                    }else{

                        var recipient_name = document.getElementById("recipient_name");
                        var recipient_phone = document.getElementById("recipient_phone");
                        var recipient_address = document.getElementById("recipient_address");
                        $.ajax({
                            url: './query/pizza_submit.php',
                            method: 'GET',
                            data: { 
                                oid : oid,
                                payment_method: method,
                                recipient_address: recipient_address.value,
                                recipient_phone: recipient_phone.value,
                                recipient_name: recipient_name.value
                            },
                            success: function(response) {   
                                var data = JSON.parse(response);
                                console.log(data)
                                if(data.status == 200){
                                    Swal.fire(
                                        'สำเร็จ!',
                                         data.message,
                                        'success'
                                    )
                                }else{
                                    Swal.fire(
                                        'ไม่สำเร็จ!',
                                         data.message,
                                        'error'
                                    )
                                }
                                setTimeout(() => {
                                    window.location.href= "history.php";
                                }, 500);
                            },
                            error: function(err) {
                                console.log(err);
                            }
                        });


                        Swal.fire(
                            'สำเร็จ!',
                            'รอการตรวจสอบจากผู้ดูแลระบบ',
                            'success'
                        )
                    }

                })


                $('.payment').click((e)=> {
                    var allPaymentChoice = document.querySelectorAll('.payment');
                    
                    // loop clear active
                    for(let i = 0 ; i < allPaymentChoice.length; i++ ){
                        // set all payment method to false
                        // unselect all
                        allPaymentChoice[i].attributes.selected.value = "false";
                    }

                    // set selected value
                    e.target.attributes.selected.value = "true";

                })


                $(".removeItem").click( (e) => {
                    var odid = e.target.attributes.value.value;
                    removeItemById(odid);
                })

                $(".decreaseItem").click((e) => {
                    var odid = e.target.attributes.value.value;
                    updateItemById(odid , "decrease",null,null);
                })

                $(".increaseItem").click((e) => {
                    var odid = e.target.attributes.value.value;
                    updateItemById(odid , "increase",null, null);
                })

                $(".sizeItem").change((e) => {
                    var size = e.target.value;
                    var odid = e.target.attributes.id.value;
                    updateItemById(odid , "update_size", size, null);
                })

                $(".crustItem").change((e) => {
                    var crust = e.target.value;
                    var odid  =  e.target.attributes.id.value;
                   updateItemById(odid , "update_crust", null , crust);
                })
                
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