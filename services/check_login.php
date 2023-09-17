<?php
    $currentPath = $_SERVER['REQUEST_URI'];
    // project/pizzashop_aj_m/pages/home.php

    $ArrayPathName = explode('/', $currentPath);
    // home.php

    $arrayPath = explode('.', $ArrayPathName[4]);
    $path = $arrayPath[0];
    // home

    // List of routes to check for authentication
    $checkPathList = ['','home','checkout','order','index'];
    
    if (in_array($ArrayPathName[3] , $checkPathList)|| in_array($path, $checkPathList)) {


        //to do if true
        // check if user not logged in redirect user to page login

        if(!isset($_SESSION['isLoggedIn'])){
            header("Location: ./login");
        }

    } else {
        //to do if not
        // if not check page continue....
    }

    $isPageFolder = $ArrayPathName[4] ? '1' : '0';
    
?>