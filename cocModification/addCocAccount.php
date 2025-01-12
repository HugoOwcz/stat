<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $hdvMax = htmlspecialchars($_POST["hdvMax"]);
    $actualHdv = htmlspecialchars($_POST["actualHdv"]);
    $mdoMax = htmlspecialchars($_POST["mdoMax"]);
    $actualMdo = htmlspecialchars($_POST["actualMdo"]);
    $email = htmlspecialchars($_POST["email"]);
    $created = htmlspecialchars($_POST["created"]);
    $maxedHdv = htmlspecialchars($_POST["maxedHdv"]);
    $maxedMdo = htmlspecialchars($_POST["maxedMdo"]);
    if ($name != '' and $hdvMax != '' and $mdoMax != '') {
        try {
            $pdo = null;
            include '../importPhp/pdo.php';
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $add = $pdo->prepare("INSERT INTO coc (pseudoAccount, hdvMax, actualHdv, mdoMax, actualMdo, email, created, maxedHdv, maxedMdo) 
                VALUES (:name, :hdvMax, :actualHdv, :mdoMax, :actualMdo, :email,:created,:maxedHdv,:maxedMdo)");
            $add->execute(['name' => $name, 'hdvMax' => $hdvMax, 'actualHdv' => $actualHdv, 'mdoMax' => $mdoMax, 'actualMdo' => $actualMdo, 'email' => $email, 'created' => $created, 'maxedHdv' => $maxedHdv, 'maxedMdo' => $maxedMdo]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
header("location:../page/coc.php");