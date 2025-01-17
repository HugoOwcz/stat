<?php
session_start();
?>
<header>
    <nav class="navBar">
        <?php
        $location = explode('/', $_SERVER['REQUEST_URI'])[3];
        if ($location != 'home.php' && $location != '') {
        ?>
        <a href="home.php" class="navButton">
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
            $_SESSION['location'] = 'home.php';
        } else {
            $_SESSION['location'] = $location;
        } ?>
    </nav>
    <form action="../modifyOption/elementViewOnPage.php" method="post">
        <label for="">What do tou want to see : </label>
        <select name="option">
            <option value="all">All</option>
            <option value="information">Only my information</option>
            <option value="forms">Only forms</option>
        </select>
        <input type="submit" value="Change">
    </form>
</header>
