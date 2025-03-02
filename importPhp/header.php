<?php
session_start();
if (empty($_SESSION['info'])) {
    $_SESSION['info'] = true;
}
if (empty($_SESSION['forms'])) {
    $_SESSION['forms'] = true;
}
function hideShowInfo () {
    $_SESSION['info'] = !$_SESSION['info'];
    echo $_SESSION['info'];
}
function hideShowForms () {
    $_SESSION['forms'] = !$_SESSION['forms'];
    echo $_SESSION['forms'];
}
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
        <a href="../modifyOption/hideShowInfo.php" class="navButton">
            <p><?php if ($_SESSION['info'] == "Show") {echo "Hide";} else {echo "Show";} ?> Information </p>
        </a>
        <a href="../modifyOption/hideShowForms.php" class="navButton">
            <p> <?php if ($_SESSION['forms'] == "Show") {echo "Hide";} else {echo "Show";} ?> Forms </p>
        </a>
    </nav>
</header>
