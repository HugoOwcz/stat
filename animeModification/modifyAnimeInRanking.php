<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $rank = htmlspecialchars($_POST["rank"]);
    if ($name != "default" && $rank != "default") {
        try {
            $pdo = null;
            include '../importPhp/pdo.php';
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $update = $pdo->prepare("UPDATE animeranking SET ranking = :rank WHERE name = :name");
            $update->execute(['rank' => $rank, 'name' => $name]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $pdo = null;
    }
}
header("location:../page/animeHome.php");