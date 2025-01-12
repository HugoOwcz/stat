<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $vo = htmlspecialchars($_POST["vo"]);
    $vf = htmlspecialchars($_POST["vf"]);
    if ($name != '') {
        try {
            $pdo = null;
            include '../importPhp/pdo.php';
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $add = $pdo->prepare("INSERT INTO watchlistAnime (name, vo, vf) 
                VALUES (:name, :vo, :vf)");
            $add->execute(['name' => $name, 'vo' => $vo, 'vf' => $vf]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
header("location:../page/anime.php");