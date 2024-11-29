<?php
session_start();
?>
<header>
    <nav class="navBar">
        <a href="index.php" class="navButton">
            <p> Home </p>
        </a>
        <?php
        $location = explode('/', $_SERVER['REQUEST_URI'])[2];
        if ( $location != 'coc.php'){
        ?>
        <a href="coc.php" class="navButton">
            <p> Clash Of Clans </p>
        </a>
        <?php
        }
        if ( $location != 'anime.php'){
        ?>
        <a href="anime.php" class="navButton">
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
