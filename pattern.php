<!DOCTYPE>
<html lang="en">
<head>
    <?php include '../importPhp/head.php' ?>
    <title>Title</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
include '../importPhp/header.php';
?>
<main>
    <h1>Title</h1>
    <?php
    if ($_SESSION['viewOption'] != 'forms') {}
    ?>
    <?php
    if ($_SESSION['viewOption'] != 'information') {}
    ?>
</main>
<footer>
    <?php include '../importPhp/toTop.php' ?>
</footer>
</body>
</html>