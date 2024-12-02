<?php

function color($actualValue, $maxValue=null)
{
    if ($actualValue == 0 or $actualValue == 'no') {
        return 'red';
    } else if ($actualValue == 'yes' or $actualValue == $maxValue) {
        return 'lightgreen';
    }
    return 'orange';
}

$accountList = array();
try {
    $pdo = null;
    include 'cocModification/pdo.php';
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $select = $pdo->prepare("SELECT * FROM coc");
    $select->execute();
    foreach ($select->fetchAll() as $account) {
        $accountList[] = $account;
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
    <title>Clash Of Clans</title>
    <link rel="stylesheet" href="css/coc.css">
</head>
<body>
<?php
include './header.php';
?>
<main>
    <h1>Clash Of Clans Accounts</h1>
    <section>
        <table>
            <caption>
                Table of Clash Of Clans accounts.
            </caption>
            <thead>
            <tr>
                <th scope="col">Nickname</th>
                <th scope="col">Hdv Max</th>
                <th scope="col">Actual Hdv</th>
                <th scope="col">Mdo max</th>
                <th scope="col">Actual Mdo</th>
                <th scope="col">Created</th>
                <th scope="col">Maxed Hdv</th>
                <th scope="col">Maxed Mdo</th>
                <th scope="col">Full max</th>
                <th scope="col">Email</th>
            </tr>
            </thead>
            <tbody>
                <?php
                $totalAccount = count($accountList);
                $accountAtMaxHdv = 0;
                $accountAtMaxMdo = 0;
                $accountCreated = 0;
                $accountMaxHdv = 0;
                $accountMaxMdo = 0;
                $accountFullMax = 0;
                foreach ($accountList as $account) {
                    if ($account['hdvMax'] == $account['actualHdv']) {
                        $accountAtMaxHdv++;
                    }
                    if ($account['mdoMax'] == $account['actualMdo']) {
                        $accountAtMaxMdo++;
                    }
                    if ($account['created'] == 'yes') {
                        $accountCreated++;
                    }
                    if ($account['maxedHdv'] == 'yes') {
                        $accountMaxHdv++;
                    }
                    if ($account['maxedMdo'] == 'yes') {
                        $accountMaxMdo++;
                    }
                    ?> <tr> <td> <?php echo $account['pseudoAccount'] ?> </td> <?php
                    ?> <td><a href="infoHdv.php?<?php echo $account['hdvMax'] ?>"> <?php echo $account['hdvMax'] ?> </a></td> <?php
                    ?> <td style="background-color: <?php echo color($account['actualHdv'], $account['hdvMax']) ?>"><a href="infoHdv.php?<?php echo $account['actualHdv'] ?>"> <?php echo $account['actualHdv'] ?> </a> </td> <?php
                    ?> <td><a href="infoMdo.php"> <?php echo $account['mdoMax'] ?> </a></td> <?php
                    ?> <td style="background-color: <?php echo color($account['actualMdo'], $account['mdoMax']) ?>"><a href="infoMdo.php"> <?php echo $account['actualMdo'] ?> </a> </td> <?php
                    ?> <td style="background-color: <?php echo color($account['created'])?>"> <?php echo $account['created'] ?> </td> <?php
                    ?> <td style="background-color: <?php echo color($account['maxedHdv'])?>"> <?php echo $account['maxedHdv'] ?> </td> <?php
                    ?> <td style="background-color: <?php echo color($account['maxedMdo'])?>"> <?php echo $account['maxedMdo'] ?> </td> <?php
                    if ($account['maxedHdv'] == 'yes' && $account['maxedMdo'] == 'yes') {
                        $accountFullMax++;
                        ?> <td style="background-color: lightgreen"> yes </td> <?php
                    } else {
                        ?> <td style="background-color: red"> no </td> <?php
                    }
                    ?> <td> <?php echo $account['email'] ?> </td> </tr> <?php
                }
                ?>
            </tbody>
        </table>
    </section>

    <section>
        <h2>Some stats</h2>
        <p>Accounts created : <progress value="<?php echo $accountCreated ?>" max="<?php echo $totalAccount ?>"></progress> <?php echo $accountCreated ?> / <?php echo $totalAccount ?></p>
        <p>Accounts full max : <progress value="<?php echo $accountFullMax ?>" max="<?php echo $totalAccount ?>"></progress> <?php echo $accountFullMax ?> / <?php echo $totalAccount ?> </p>
        <p>Accounts with maxed hdv : <progress value="<?php echo $accountMaxHdv ?>" max="<?php echo $totalAccount ?>"></progress> <?php echo $accountMaxHdv ?> / <?php echo $totalAccount ?> </p>
        <p>Accounts at max hdv : <progress value="<?php echo $accountAtMaxHdv ?>" max="<?php echo $totalAccount ?>"></progress> <?php echo $accountAtMaxHdv ?> / <?php echo $totalAccount ?> </p>
        <p>Accounts with maxed mdo : <progress value="<?php echo $accountMaxMdo ?>" max="<?php echo $totalAccount ?>"></progress> <?php echo $accountMaxMdo ?> / <?php echo $totalAccount ?> </p>
        <p>Accounts at max mdo : <progress value="<?php echo $accountAtMaxMdo ?>" max="<?php echo $totalAccount ?>"></progress> <?php echo $accountAtMaxMdo ?> / <?php echo $totalAccount ?> </p>
    </section>

    <section>
        <h2>Add an account</h2>
        <form method="post" action="cocModification/addCocAccount.php">
            <div>
            <label for="">Name of the account : </label>
            <input type="text" name="name" required>
            </div><div>
            <label for="">Max Hdv for the account : </label>
            <input type="text" name="hdvMax" required>
            </div><div>
            <label for="">Actual Hdv of the account : </label>
            <input type="text" name="actualHdv">
            </div><div>
            <label for="">Max Mdo for the account : </label>
            <input type="text" name="mdoMax" required>
            </div><div>
            <label for="">Actual mdo of the account : </label>
            <input type="text" name="actualMdo">
            </div><div>
            <label for="">Email of the account : </label>
            <input type="text" name="email">
            </div><div>
            <label for="">Account created : </label>
            <select name="created">
                <option value="no" selected="selected">No</option>
                <option value="yes">Yes</option>
            </select>
            </div><div>
            <label for="">Hdv maxed : </label>
            <select name="maxedHdv">
                <option value="no" selected="selected">No</option>
                <option value="yes">Yes</option>
            </select>
            </div><div>
            <label for="">Mdo maxed : </label>
            <select name="maxedMdo">
                <option value="no" selected="selected">No</option>
                <option value="yes">Yes</option>
            </select>
            </div><div>
            <input type="submit" value="Add the account">
            </div>
        </form>
    </section>

    <section>
        <h2>Modify data of an account</h2>
        <form method="post" action="cocModification/modifyCocAccount.php">
            <div>
            <label for="">Name of the account you want to modify : </label>
            <select name="name">
                <option value="default" selected="selected">Choose an account</option>
                <?php
                foreach ($accountList as $account) {
                    $name = $account['pseudoAccount'];
                    ?>
                    <option value="<?php echo $name ?>"> <?php echo $name ?> </option>
                <?php
                }
                ?>
            </select>
            </div><div>
            <label for="">Value you want to modify : </label>
            <select name="key">
                <option value="default" selected="selected">Choose a value</option>
                <option value="name">Account nickname</option>
                <option value="hdvMax">Max Hdv</option>
                <option value="actualHdv">Actual Hdv</option>
                <option value="mdoMax">Max Mdo</option>
                <option value="actualMdo">Actual Mdo</option>
                <option value="email">Email</option>
                <option value="created">Created</option>
                <option value="maxedHdv">Maxed Hdv</option>
                <option value="maxedMdo">Maxed Mdo</option>
            </select>
            </div><div>
            <label for="">New value : </label>
            <select name="value">
                <option value="default" selected="selected">Choose a value</option>
                <option value="no">No</option>
                <option value="yes">Yes</option>
                <option value="other">Other</option>
            </select>
            </div><div>
            <label for="">Other : </label>
            <input type="text" name="otherValue">
            </div><div>
            <input type="submit" value="Modify the account">
            </div>
        </form>
    </section>

    <section>
        <h2>Delete an account</h2>
        <form method="post" action="cocModification/deleteCocAccount.php">
            <div>
            <label for="">Name of the account you want to delete : </label>
            <select name="name">
                <option value="default" selected="selected">Choose an account</option>
                <?php
                foreach ($accountList as $account) {
                    $name = $account['pseudoAccount'];
                    ?>
                    <option value="<?php echo $name ?>"> <?php echo $name ?> </option>
                    <?php
                }
                ?>
            </select>
            </div><div>
            <input type="submit" value="Delete the account">
            </div>
        </form>
    </section>

</main>
<footer>
    <?php include 'toTop.php' ?>
</footer>
</body>
</html>