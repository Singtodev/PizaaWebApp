<?php
    session_start();
    include_once('../utils/condb.php');
    include_once('../utils/datethai.php');
    
    if(!$_SESSION['user_data']){
        echo 'Unauthorize';
        exit(0);
    }


    if(!isset($_GET['show_id'])){
        echo 'No Record!';
        exit(0);
    }

    $sql = "SELECT * 
    FROM  iorder , user
    where iorder.uid = user.uid
    and   iorder.status = ?
    order by odate DESC";

    $stmt = $condb->prepare($sql);
    $stmt->bind_param('s',$_GET['show_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    $i = 0;

    if($result->num_rows == 0){
        echo '<div class="text-center py-2">ไม่มีข้อมูล</div>';
        exit(0);
    }

?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <div class="pizza_admin_table  grid grid-cols-1">

            <div class="w-full grid grid-cols-8 py-4">
                            <div class="px-1"># รหัสออเดอร์ </div>
                            <div class="px-1"># ลูกค้า  </div>
                            <div class="px-1"># ที่อยู่จัดส่ง  </div>
                            <div class="px-1"># วันที่ </div>
                            <div class="px-1"></div>
                            <div class="px-1"># ประเภทการชำระ</div>
                            <div class="px-1"># จำนวนเงิน </div>
                            <div class="px-1"></div>
            </div>

            <?php 

                while($row = $result->fetch_assoc()){  $i++;  ?>
                    <div class="w-full grid grid-cols-8 py-4 <?php echo ($i % 2 == 0 ? 'bg-gray-200'  : 'bg-white'  ); ?>">
                            <div class="px-4 whitespace-nowrap"><?php echo $row['oid'] ?></div>
                            <div class="px-1 whitespace-nowrap"><?php echo $row['name'] ?></div>
                            <div class="px-1 whitespace-wrap"><?php echo $row['recipient_address'] ?></div>
                            <div class="px-1 whitespace-nowrap"><?php echo getThaiDateWithTime($row['odate']) ?></div>
                            <div class="px-1"></div>
                            <div class="px-1"><?php echo $row['payment_method'] ?></div>
                            <div class="px-1 whitespace-nowrap"><?php echo $row['total'] ?></div>
                            <div class="inline-block flex items-center">

                                <?php 
                                    if($row['status'] == 2 ){ ?>
                                    <div class="flex flex-row item-center gap-x-2">
                                        <div oid="<?php echo $row['oid'] ?>" class="confirm-order whitespace-wrap flex items-center justify-center cursor-pointer hover:bg-opacity-50 transition-all duration-300 bg-blue-600 gap-x-4 px-2 text-white rounded-md">อนุมัติ <i class="fa-solid fa-check"></i></div>
                                        <a href="history_show.php?oid=<?= $row['oid'] ?>" class="h-full">
                                            <div class="whitespace-wrap py-2 w-full h-full flex items-center justify-center cursor-pointer hover:bg-opacity-50 transition-all duration-300 bg-yellow-600 px-2 text-white rounded-md"><i class="fa-solid fa-eye"></i></div>
                                        </a>
                                    </div>
                                <?php } ?>

                                <?php 
                                    if($row['status'] == 3 ){ ?>
                                    <div class="flex flex-row item-center gap-x-2">
                                    <div class="whitespace-wrap flex items-center justify-center transition-all duration-300 bg-lime-600 gap-x-4 px-2 text-white rounded-md">สำเร็จ</div>
                                            <a href="history_show.php?oid=<?= $row['oid'] ?>" class="h-full">
                                            <div class="whitespace-wrap py-2 w-full h-full flex items-center justify-center cursor-pointer hover:bg-opacity-50 transition-all duration-300 bg-yellow-600 px-2 text-white rounded-md"><i class="fa-solid fa-eye"></i></div>
                                        </a>
                                    </div>
                                <?php } ?>

                            </div>
                    </div>
            <?php } ?>
        </div>

        <script>

function removeAllActiveMenu(){
    var doms = document.querySelectorAll('.menu-select');
    for(let i = 0 ; i < doms.length; i++ ){
        doms[i].classList.remove("btn-active");
    }
}

$(document).ready(function(){

    $(".confirm-order").click((e) => {

        var oid = e.currentTarget.attributes['oid'].value;

        Swal.fire({
                        title: 'ยืนยันการจัดส่งอาหาร',
                        text: 'หากคุณมั่นใจว่าส่งอาหารเรียบร้อยแล้ว',
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#2563eb',
                        cancelButtonColor: '#131921',
                        cancelButtonText: 'ยกเลิก',
                        confirmButtonText: 'ตกลง'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: './query/pizza_order_update.php',
                                method: 'GET',
                                data: { 
                                    oid: oid,
                                    status: 3
                                },
                                success: function(response) {   
                                    console.log(response);
                                    var data = JSON.parse(response);

                                    if(data.status == 400){
                                        Swal.fire(
                                        'ไม่สำเร็จ!',
                                        data.message,
                                        'error'
                                        )
                                    }

                                    if(data.status == 200){
                                        Swal.fire(
                                        'สำเร็จ!',
                                        'ยืนยันการส่งอาหารเรียบร้อย',
                                        'success'
                                        )
                                    }

                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 1000)
                                },
                                error: function() {
                                    console.log("filter error");
                                }
                            });;
                      }
        });
    })
});


</script>