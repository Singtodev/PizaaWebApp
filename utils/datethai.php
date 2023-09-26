<?php

    function getThaiDate($date){
        $newDate = new DateTime($date);
        $mday = $newDate->format("j");  // Use "j" to get day without leading zeros
        $mon = $newDate->format("n");
        $year = $newDate->format("Y");
        $year = $year + 543;
        $thmonth = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $mon = $thmonth[$mon];
        return "$mday $mon $year";
    }


?>