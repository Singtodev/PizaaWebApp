<?php
    $current_folder = basename(__DIR__);
    $listOfProtectFolder = array("services","layouts","components");
    if(in_array($current_folder , $listOfProtectFolder)){
        echo $current_folder;
        echo 'denide';
    }
?>