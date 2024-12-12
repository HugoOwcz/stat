<?php
$tmp = explode('?', $_SERVER['REQUEST_URI'])[1];
$hdvOrmdo = explode('-', $tmp)[0];
$level = explode('-', $tmp)[1];
$infoBuildingList = array();
$intoTroopList = array();
try {
    $pdo = null;
    include 'cocModification/pdo.php';
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $select = $pdo->prepare("SELECT * FROM buildingsinfoforhdvmdo WHERE HdvOrMdo = :hdvormdo AND levelHdvMdo = :level");
    $select->execute(['hdvormdo' => $hdvOrmdo, 'level' => $level]);
    foreach ($select->fetchAll() as $infoBuilding) {
        $infoBuildingList[] = $infoBuilding;
    }
    $select = $pdo->prepare("SELECT * FROM troopinfoforhdvmdo WHERE HdvOrMdo = :hdvormdo AND levelHdvMdo = :level");
    $select->execute(['hdvormdo' => $hdvOrmdo, 'level' => $level]);
    foreach ($select->fetchAll() as $troopInfo) {
        $intoTroopList[] = $troopInfo;
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
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
include './header.php';
?>
<main>
    <h1><?php echo $hdvOrmdo;?> <?php echo $level ?></h1>
    <section>
        <table>
            <caption>Info for the buildings of this <?php echo $hdvOrmdo;?></caption>
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
                foreach ($infoBuildingList as $infoBuilding) { ?>
                    <tr>
                        <td><?php echo $infoBuilding["buildings"] ?></td>
                        <td><?php echo $infoBuilding["maxLevel"] ?></td>
                        <td><?php echo $infoBuilding["nbBuildings"] ?></td>
                        <td><?php echo $infoBuilding["type"] ?></td>
                    </tr>
            <?php } ?>
            </tbody>
        </table>
    </section>

    <section>
        <table>
            <caption>Info for the troop of this <?php echo $hdvOrmdo;?></caption>
            <thead>
            <tr>
                <th scope="col">Name of the troop</th>
                <th scope="col">Max level of the troop</th>
                <th scope="col">Target of the troop</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($intoTroopList as $infoTroop) { ?>
                <tr>
                    <td><?php echo $infoTroop["name"] ?></td>
                    <td><?php echo $infoTroop["maxLevel"] ?></td>
                    <td><?php echo $infoTroop["type"] ?></td>
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
                    foreach ($infoBuildingList as $infoBuilding) {
                        $name = $infoBuilding['buildings'];
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
                    foreach ($infoBuildingList as $infoBuilding) {
                        $name = $infoBuilding['buildings'];
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