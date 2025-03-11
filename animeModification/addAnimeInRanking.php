<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $rank = htmlspecialchars($_POST["rank"]);
    if ($name != '' && $rank != 'default') {
        try {
            $pdo = null;
            include '../importPhp/pdo.php';
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $add = $pdo->prepare("INSERT INTO animeRanking (name, ranking) 
                VALUES (:name, :rank)");
            $add->execute(['name' => $name, 'rank' => $rank]);
            $delete = $pdo->prepare("DELETE FROM watchlistAnime WHERE name = :name");
            $delete->execute(['name' => $name]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
header("location:../page/animeRanking.php");