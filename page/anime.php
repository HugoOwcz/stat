<?php
$animeList = array();
try {
    $pdo = null;
    include '../importPhp/pdo.php';
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $select = $pdo->prepare("SELECT * FROM animeRanking");
    $select->execute();
    foreach ($select->fetchAll() as $anime) {
        $animeList[] = $anime;
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

$watchlist = array();
try {
    $pdo = null;
    include '../importPhp/pdo.php';
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $select = $pdo->prepare("SELECT * FROM watchlistAnime");
    $select->execute();
    foreach ($select->fetchAll() as $anime) {
        $watchlist[] = $anime;
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
$pdo = null;
?>
<!DOCTYPE>
<html lang="en">
<head>
    <?php include '../importPhp/head.php' ?>
    <title>Anime</title>
</head>
<body>
<?php
include '../importPhp/header.php';
?>
<main>
    <h1>Anime</h1>
    <section>
        <h2>Ranking</h2>
    </section>
    <section>
        <table>
            <caption>WatchList</caption>
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Vo</th>
                <th scope="col">Vf</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($watchlist as $anime) { ?>
                <tr>
                    <td><?php echo $anime['name']?> </td>
                    <td><?php echo $anime['vo']?> </td>
                    <td><?php echo $anime['vf']?> </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </section>
    <section>
        <h2>Rank an anime</h2>
        <form action="../animeModification/addAnimeInRanking.php" method="post">
            <div>
                <label for="">Name : </label>
                <input type="text" name="name" required>
            </div><div>
                <label for="">Rank : </label>
                <select name="rank">
                    <option value="default">Choose a rank</option>
                    <option value="S">S</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                </select>
            </div><div>
                <input type="submit" value="Rank the anime">
            </div>
        </form>
    </section>
    <section>
        <h2>Add an anime in watchlist</h2>
        <form action="../animeModification/addAnimeInWatchlist.php" method="post">
            <div>
                <label for="">Name : </label>
                <input type="text" name="name" required>
            </div><div>
                <label for="">Vo : </label>
                <select name="vo">
                    <option value="null">I don't no</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div><div>
                <label for="">Vf : </label>
                <select name="vf">
                    <option value="null">I don't no</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div><div>
                <input type="submit" value="Add Anime to watchlist">
            </div>
        </form>
    </section>
    <section>
        <h2>Modify a ranking anime</h2>
    </section>
    <section>
        <h2>Modify anime in watchlist</h2>
    </section>
    <section>
        <h2>Delete a ranking anime</h2>
        <form method="post" action="../animeModification/deleteAnimeInRanking.php">
            <div>
                <label for="">Name of the anime you want to delete : </label>
                <select name="name">
                    <option value="default" selected="selected">Choose an anime</option>
                    <?php
                    foreach ($animeList as $anime) {
                        $name = $anime['name'];
                        ?>
                        <option value="<?php echo $name ?>"> <?php echo $name ?> </option>
                    <?php } ?>
                </select>
            </div><div>
                <input type="submit" value="Delete the anime">
            </div>
        </form>
    </section>
    <section>
        <h2>Delete anime in watchlist</h2>
        <form method="post" action="../animeModification/deleteAnimeInWatchlist.php">
            <div>
                <label for="">Name of the anime you want to delete : </label>
                <select name="name">
                    <option value="default" selected="selected">Choose an anime</option>
                    <?php
                    foreach ($watchlist as $anime) {
                        $name = $anime['name'];
                        ?>
                        <option value="<?php echo $name ?>"> <?php echo $name ?> </option>
                        <?php } ?>
                </select>
            </div><div>
                <input type="submit" value="Delete the anime">
            </div>
        </form>
    </section>
</main>
<footer>
    <?php include '../importPhp/toTop.php' ?>
</footer>
</body>
</html>