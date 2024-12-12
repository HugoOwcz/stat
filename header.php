<?php
session_start();
?>
<header>
    <nav class="navBar">
        <?php
        $location = explode('/', $_SERVER['REQUEST_URI'])[2];
        if ($location != 'index.php' && $location != '') {
        ?>
        <a href="index.php" class="navButton">
            <p> Home </p>
        </a>
        <?php
        }
        if ( $location != 'coc.php'){
        ?>
        <a href="coc.php" class="navButton">
            <p>Clash Of Clans</p>
        </a>
        <?php
        }
        if ( $location != 'videoGame.php'){
            ?>
            <a href="videoGame.php" class="navButton">
                <p>Video Game</p>
            </a>
            <?php
        }
        if ( $location != 'anime.php'){
        ?>
        <a href="anime.php" class="navButton">
            <p>Anime</p>
        </a>
        <?php
        }
        if ( $location != 'film.php'){
            ?>
            <a href="film.php" class="navButton">
                <p>Film</p>
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
