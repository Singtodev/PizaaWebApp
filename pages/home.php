<?php
    require_once('../services/index.php');
    require_once('../components/index.php');
    
    $navbar = new Navbar(
        $isPageFolder,
        $userData
    );
?>
<!DOCTYPE html>
<html lang="en">
<?php
    require_once('../utils/head.php')
?>
<body>
    <div>
        <?php $navbar->build();?>
    </div>
</body>
</html>