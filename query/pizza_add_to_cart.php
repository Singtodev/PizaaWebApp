<?php

    session_start();

    if(!isset($_SESSION['user_data'])){
        echo 'Please login for use add item to cart';
        exit(0);
    }

    echo 'U Are Logged In!';




?>