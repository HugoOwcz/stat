<?php
$tmp = explode('?', $_SERVER['REQUEST_URI'])[1];
$hdvOrmdo = explode('-', $tmp)[0];
$level = explode('-', $tmp)[1];
$infoList = array();
try {
    $pdo = null;
    include 'cocModification/pdo.php';
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $select = $pdo->prepare("SELECT * FROM buildingsinfoforhdvmdo WHERE HdvOrMdo = :hdvormdo AND levelHdvMdo = :level");
    $select->execute(['hdvormdo' => $hdvOrmdo, 'level' => $level]);
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
    <title><?php echo $hdvOrmdo;?> <?php echo $level ?></title>
    <link rel="stylesheet" href="css/coc.css">
</head>
<body>
<?php
include './header.php';
?>
<main>
    <h1><?php echo $hdvOrmdo;?> <?php echo $level ?></h1>
    <section>
        <table>
            <caption>Info for this <?php echo $hdvOrmdo;?></caption>
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
        <h2>Add building for <?php echo $hdvOrmdo;?> <?php echo $level ?></h2>
        <form method="post" action="cocModification/addInfoHdv.php">
            <input type="hidden" name="hdvOrMdo" value="<?php echo $hdvOrmdo?>">
            <input type="hidden" name="level" value="<?php echo $level?>">
            <div>
                <label for="">Building name : </label>
                <input type="text" name="buildingName" required>
            </div>
            <div>
                <label for="">Max level of the building : </label>
                <input type="text" name="maxLevel" required>
            </div>
            <div>
                <label for="">Number of copies : </label>
                <input type="text" name="copies" required>
            </div>
            <div>
                <label for="">Type of the building : </label>
                <input type="text" name="type" required>
            </div>
            <input type="submit" value="Add new building">
        </form>
    </section>

    <section>
        <h2>Delete building for <?php echo $hdvOrmdo;?> <?php echo $level ?></h2>
        <form method="post" action="cocModification/deleteInfoHdv.php">
            <input type="hidden" name="hdvOrMdo" value="<?php echo $hdvOrmdo?>">
            <input type="hidden" name="level" value="<?php echo $level?>">
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

    <section>
        <h2>Add troop for <?php echo $hdvOrmdo;?> <?php echo $level ?></h2>
        <form method="post" action="cocModification/addInfoHdv.php">
            <input type="hidden" name="hdvOrMdo" value="<?php echo $hdvOrmdo?>">
            <input type="hidden" name="level" value="<?php echo $level?>">
            <div>
                <label for="">Troop name : </label>
                <input type="text" name="troopName" required>
            </div>
            <div>
                <label for="">Max level of the troop : </label>
                <input type="text" name="maxLevel" required>
            </div>
            <div>
                <label for="">Type of the troop : </label>
                <input type="text" name="type" required>
            </div>
            <input type="submit" value="Add new troop">
        </form>
    </section>

    <section>
        <h2>Delete troop for <?php echo $hdvOrmdo;?> <?php echo $level ?></h2>
        <form method="post" action="cocModification/deleteInfoHdv.php">
            <input type="hidden" name="hdvOrMdo" value="<?php echo $hdvOrmdo?>">
            <input type="hidden" name="level" value="<?php echo $level?>">
            <div>
                <label for="">Troop name : </label>
                <select name="name">
                    <option value="default" selected="selected">Choose a troop</option>
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