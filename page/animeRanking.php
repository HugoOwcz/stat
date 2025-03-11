<?php
function color($value) {
    switch ($value) {
        case "S":
            return "green";
        case "A":
            return "forestgreen";
        case "B":
            return "lightgreen";
        case "C":
            return "yellow";
        case "D":
            return "orange";
        case "E":
            return "red";
        default:
            return "lightgray";
    }
}

$animeList = array();
$animeListTab = array();
try {
    $pdo = null;
    include '../importPhp/pdo.php';
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $select = $pdo->prepare("SELECT * FROM animeRanking");
    $select->execute();
    foreach ($select->fetchAll() as $anime) {
        $animeList[] = $anime;
        $animeListTab[] = $anime;
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE>
<html lang="en">
<head>
    <?php include '../importPhp/head.php' ?>
    <title>Anime Ranking</title>
    <link rel="icon" href="../img/podium.webp">
</head>
<body>
<?php
include '../importPhp/header.php';
include '../importPhp/navbarAnime.php';
?>
<main>
    <h1>Anime Ranking</h1>
    <?php if ($_SESSION['info'] == "Show") { ?>
    <section>
        <table>
            <caption>Ranking</caption>
            <thead>
            <tr>
                <th scope="col">S</th>
                <th scope="col">A</th>
                <th scope="col">B</th>
                <th scope="col">C</th>
                <th scope="col">D</th>
                <th scope="col">E</th>
            </tr>
            </thead>
            <tbody>
            <?php while (count($animeListTab) > 0) { ?>
                <tr>
                    <?php
                    $letterSearch = array( 0 => "S", 1 => "A", 2 => "B", 3 => "C", 4 => "D", 5 => "E");
                    for ($i = 0; $i < count($letterSearch); $i++) {
                        $result = array();
                        for ($j = 0; $j < count($animeListTab); $j++) {
                            if ($animeListTab[$j]['ranking'] == $letterSearch[$i]) {
                                $result[] = $animeListTab[$j]['ranking'];
                                $result[] = $animeListTab[$j]['name'];
                                array_splice($animeListTab, $j, 1);
                                break;
                            }
                        }
                        if (count($result) == 0) {
                            $result[] = "";
                            $result[] = "";
                        }
                        $link = "";
                        if (count($result) > 0) {
                            $link = strtolower($result[1]);
                            $link = str_replace(" ", "-", $link);
                        }
                        ?>
                        <td style="background-color: <?php echo color($result[0]) ?>"><a href=" https://anime-sama.fr/catalogue/<?php echo $link ?>" target="_blank"> <?php
                            echo $result[1];
                            ?></a></td> <?php } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </section>
    <?php } if ($_SESSION['forms'] == "Show") { ?>
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
            <h2>Modify a ranking anime</h2>
            <form action="../animeModification/modifyAnimeInRanking.php" method="post">
                <div>
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
                    <select name="rank">
                        <option value="default">Choose a new rank</option>
                        <option value="S">S</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                    </select>
                </div><div>
                    <input type="submit" value="Modify the rank of the anime">
                </div>
            </form>
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
    <?php } ?>
</main>
<footer>
    <?php include '../importPhp/toTop.php' ?>
</footer>
</body>
</html>
