<!DOCTYPE>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clash Of Clans</title>
</head>
<body>
<?php
include './header.php';
?>
<main>
    <h1>Clash Of Clans</h1>
    <section>
        <h2>Some stat</h2>
    </section>
    <section>
        <h2>All account in a tab</h2>
    </section>
    <section>
        <h2>Add data of account</h2>
        <form method="post" action="addCocAccount.php">
            <label for="">Name of the account : </label>
            <input type="text" name="name" required>
            <br>
            <label for="">Hdv max for the account : </label>
            <input type="text" name="hdvMax" required>
            <br>
            <label for="">Actual Hdv of the account : </label>
            <input type="text" name="actualHdv">
            <br>
            <label for="">Mdo max for the account : </label>
            <input type="text" name="mdoMax" required>
            <br>
            <label for="">Actual mdo of the account : </label>
            <input type="text" name="actualMdo">
            <br>
            <label for="">Email of the account : </label>
            <input type="text" name="email">
            <br>
            <label for="">Account create : </label>
            <select name="created">
                <option value="no" selected="selected">No</option>
                <option value="yes">Yes</option>
            </select>
            <br>
            <label for="">Hdv maxed : </label>
            <select name="maxedHdv">
                <option value="no" selected="selected">No</option>
                <option value="yes">Yes</option>
            </select>
            <br>
            <label for="">Mdo maxed : </label>
            <select name="maxedMdo">
                <option value="no" selected="selected">No</option>
                <option value="yes">Yes</option>
            </select>
            <br>
            <input type="submit" value="Add">
        </form>
    </section>
    <section>
        <h2>Modify data of account</h2>
        <form method="post" action="fefefe">
            <label for="">Name of the account you want to modify : </label>
            <select name="name">
                <option value="default" selected="selected">Choose an account</option>
                <?php
                ?>
            </select>
            <br>
            <label for="">Value you want to modify : </label>
            <select name="column">
                <option value="default" selected="selected">Choose a value</option>
                <option value="name">Account name</option>
                <option value="hdvMax">Hdv max</option>
                <option value="actualHdv">Actual Hdv</option>
                <option value="mdoMax">Mdo max</option>
                <option value="actualMdo">Actual Mdo</option>
                <option value="email">Email</option>
                <option value="created">Created</option>
                <option value="maxedHdv">Maxed Hdv</option>
                <option value="maxedMdo">Maxed Mdo</option>
            </select>
            <br>
            <label for="">New value : </label>
            <select name="newValueSelect">
                <option value="default" selected="selected">Choose a value</option>
                <option value="perso">Enter the value in the area under.</option>
                <option value="no">No</option>
                <option value="yes">Yes</option>
            </select>
            <br>
            <input type="text" name="newValueInput">
            <br>
            <input type="submit" value="Add">
        </form>
    </section>
</main>
</body>
</html>