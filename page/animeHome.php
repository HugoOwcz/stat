<!DOCTYPE>
<html lang="en">
<head>
    <?php include '../importPhp/head.php' ?>
    <title>Anime</title>
    <link rel="icon" href="../img/Ahjin.webp">
</head>
<body>
<?php
include '../importPhp/header.php';
?>
<main>
    <h1>Anime</h1>
    <section class="categories">
        <a href="animeRanking.php" class="choice">
            <section class="category">
                <h2>Anime Ranking</h2>
                <img src="../img/podium.webp" alt="image of podium">
            </section>
        </a>
        <a href="animeWatchlist.php" class="choice">
            <section class="category">
                <h2>Anime Watchlist</h2>
                <img src="../img/watchlist.webp" alt="image of anime watchlist with binocular">
            </section>
        </a>
    </section>
</main>
<footer>
    <?php include '../importPhp/toTop.php' ?>
</footer>
</body>
</html>