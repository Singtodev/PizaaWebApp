<?php
    $currentPath = $_SERVER['REQUEST_URI'];
    // project/pizzashop_aj_m/pages/home.php

    $ArrayPathName = explode('/', $currentPath);
    // home.php

    $arrayPath = explode('.', $ArrayPathName[4]);
    $path = $arrayPath[0];
    // home

    // List of routes to check for authentication
    $checkPathList = ['home','checkout','order','index.php'];

    if (in_array($path, $checkPathList)) {
        //to do if true
    } else {
        //to do if not
    }

    $isPageFolder = $ArrayPathName[4] ? '1' : '0';
    
?>