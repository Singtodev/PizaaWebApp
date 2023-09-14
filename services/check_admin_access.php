<?php

    $currentPath = $_SERVER['REQUEST_URI'];
    // project/pizzashop_aj_m/pages/home.php

    $ArrayPathName = explode('/', $currentPath);
    // home.php

    $arrayPath = explode('.', $ArrayPathName[4]);
    $path = $arrayPath[0];
    // home

    // List of routes to check for access
    $checkPathList = ['admin_dashboard','admin_home','admin_edit','admin_manager'];

    if (in_array($ArrayPathName[3] , $checkPathList)|| in_array($path, $checkPathList)) {
        // fetching user data;
        if(!isset($userData['data']['m_role']) || $userData['data']['m_role'] != 'admin'){
            header("Location: ./home");
        }

    } else {
        //to do if not
        // if not check page continue....
    }


?>