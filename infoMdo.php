<?php
$hdv = explode('?', $_SERVER['REQUEST_URI'])[1]
?>
<!DOCTYPE>
<html lang="en">
<head>
    <?php include 'head.php' ?>
    <title>Mdo <?php echo $hdv?></title>
</head>
<body>
<?php
include './header.php';
?>
<main>
    <h1>Mdo <?php echo $hdv?></h1>
</main>
<footer>
    <?php include 'toTop.php' ?>
</footer>
</body>
</html>