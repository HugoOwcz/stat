<?php
function color($value) {
    switch ($value) {
        case "yes":
            return "lightgreen";
        case "no":
            return "red";
        default:
            return "lightgray";
    }
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
    <title>Anime Watchlist</title>
    <link rel="icon" href="../img/Ahjin.webp">
</head>
<body>
<?php
include '../importPhp/header.php';
?>
<main>
    <h1>Anime Watchlist</h1>
    <?php if ($_SESSION['info'] == "Show") { ?>
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
                        <td style="background-color: <?php echo color($anime['vo']) ?>"> <?php echo $anime['vo']?> </td>
                        <td style="background-color: <?php echo color($anime['vf']) ?>"> <?php echo $anime['vf']?> </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </section>
    <?php } if ($_SESSION['forms'] == "Show") { ?>
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
            <h2>Modify anime in watchlist</h2>
            <form action="../animeModification/modifyAnimeInWatchlist.php" method="post">
                <div>
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
                    <select name="version">
                        <option value="default">Choose a version</option>
                        <option value="vo">Vo</option>
                        <option value="vf">Vf</option>
                    </select>
                </div><div>
                    <select name="value">
                        <option value="default">Choose the new value</option>
                        <option value="null">I don't no</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div><div>
                    <input type="submit" value="Modify the anime in the watchlist">
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
    <?php } ?>
</main>
<footer>
    <?php include '../importPhp/toTop.php' ?>
</footer>
</body>
</html>
