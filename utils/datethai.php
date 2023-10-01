<?php

    function getThaiDateWithTime($date) {
        $newDate = new DateTime($date);
        $mday = $newDate->format("j");  // Use "j" to get day without leading zeros
        $mon = $newDate->format("n");
        $year = $newDate->format("Y");
        $year = $year + 543;
        $thmonth = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $mon = $thmonth[$mon];
        $time = $newDate->format("H:i:s"); // Format for time (hours:minutes:seconds)
        return "$mday $mon $year $time";
    }



?>