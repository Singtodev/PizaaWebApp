<?php
    session_start();
    $_SESSION['isLoggedIn'] = true;
    header("Location: home");
?>