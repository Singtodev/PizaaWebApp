<?php

    if(!$_SESSION['uid']){
        $userData = array(
                "data" => [
                    "m_full_name" => "Singharat Bunphim",
                    "m_f_name" => "Singharat",
                    "m_l_name" => "Bunphim",
                    "m_role" => "admin",
                    "m_point" => 10000,
                    "m_avatar" => "https://images.unsplash.com/photo-1643725173053-ed68676f1878?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                ], 
                "shopping_cart" => ["pizz1","pizza2","pizza3","pizza4","pizza5"]
        );
    }else{
        $userData = array();
    }

?>