<?php
session_start();
?>
<header>
    <nav>
        <a href="index.php">
            <p> Home </p>
        </a>
        <?php
        $location = explode('/', $_SERVER['REQUEST_URI'])[2];
        if ( $location != 'coc.php'){
        ?>
        <a href="coc.php">
            <p> Clash Of Clans </p>
        </a>
        <?php
        }
        if ( $location != 'anime.php'){
        ?>
        <a href="anime.php">
            <p> Anime </p>
        </a>
        <?php
        }
        if ($location == '') {
            $_SESSION['location'] = 'index.php';
        } else {
            $_SESSION['location'] = $location;
        } ?>
    </nav>
</header>
