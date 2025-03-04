<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $version = htmlspecialchars($_POST["version"]);
    $value = htmlspecialchars($_POST["value"]);
    if ($name != "default" && $version != "default" && $value != "default") {
        try {
            $pdo = null;
            include '../importPhp/pdo.php';
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            switch ($version) {
                case "vo":
                    $update = $pdo->prepare("UPDATE watchlistanime SET vo = :value WHERE name = :name ");
                    $update->execute(['value' => $value, 'name' => $name]);
                    break;
                case 'vf':
                    $update = $pdo->prepare("UPDATE watchlistanime SET vf = :value WHERE name = :name ");
                    $update->execute(['value' => $value, 'name' => $name]);
                    break;
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $pdo = null;
    }
}
header("location:../page/animeHome.php");