<?php
$hdv = explode('?', $_SERVER['REQUEST_URI'])[1];
$infoList = array();
try {
    $pdo = null;
    include 'cocModification/pdo.php';
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $select = $pdo->prepare("SELECT * FROM hdvinfo WHERE hdv = :hdv");
    $select->execute(['hdv' => $hdv]);
    foreach ($select->fetchAll() as $info) {
        $infoList[] = $info;
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
$pdo = null;
?>
<!DOCTYPE>
<html lang="en">
<head>
    <?php include 'head.php' ?>
    <title>Hdv <?php echo $hdv?></title>
    <link rel="stylesheet" href="css/coc.css">
</head>
<body>
<?php
include './header.php';
?>
<main>
    <h1>Hdv <?php echo $hdv?></h1>
    <section>
        <table>
            <caption>Info for this Hdv</caption>
            <thead>
            <tr>
                <th scope="col">Name of the building</th>
                <th scope="col">Max level of the building</th>
                <th scope="col">Number of copies of the building</th>
                <th scope="col">Type of the building</th>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach ($infoList as $info) { ?>
                    <tr>
                        <td><?php echo $info["buildings"] ?></td>
                        <td><?php echo $info["maxLevel"] ?></td>
                        <td><?php echo $info["nbBuildings"] ?></td>
                        <td><?php echo $info["type"] ?></td>
                    </tr>
            <?php } ?>
            </tbody>
        </table>
    </section>

    <section>
        <h2>Add info for Hdv <?php echo $hdv ?></h2>
        <form method="post" action="cocModification/addInfoHdv.php">
            <input type="hidden" name="hdv" value="<?php echo $hdv?>">
            <div>
                <label for="">Buildings name</label>
                <input type="text" name="buildingName" required>
            </div>
            <div>
                <label for="">Max level of the building</label>
                <input type="text" name="maxLevel" required>
            </div>
            <div>
                <label for="">Number of copies</label>
                <input type="text" name="copies" required>
            </div>
            <div>
                <label for="">Type of the building</label>
                <input type="text" name="type" required>
            </div>
            <input type="submit" value="Add new info">
        </form>
    </section>

    <section>
        <h2>Delete info for Hdv <?php echo $hdv ?></h2>
        <form method="post" action="cocModification/deleteInfoHdv.php">
            <input type="hidden" name="hdv" value="<?php echo $hdv?>">
            <div>
                <label for="">Buildings name : </label>
                <select name="name">
                    <option value="default" selected="selected">Choose a building</option>
                    <?php
                    foreach ($infoList as $info) {
                        $name = $info['buildings'];
                        ?>
                        <option value="<?php echo $name ?>"> <?php echo $name ?> </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <input type="submit" value="Delete info">
        </form>
    </section>
</main>
<footer>
    <?php include 'toTop.php' ?>
</footer>
</body>
</html>