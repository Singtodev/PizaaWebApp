<?php
    $title = "พิซซ่าโปรเจคอาจารย์ M";
    echo '<head>';
        echo '<meta http-equiv="refresh" content="60"  charset="UTF-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '<title>'.$title.'</title>';
        echo '<script src="https://cdn.tailwindcss.com"></script>';
        echo $isPageFolder ? '<link rel="stylesheet" href="../styles/main.css">' : '<link rel="stylesheet" href="./styles/main.css">';
        echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />';
    echo '</head>';
?>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( "", "", window.location.href );
    }
</script>