<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $key = htmlspecialchars($_POST["key"]);
    $value = htmlspecialchars($_POST["value"]);
    if ($name != "default" && $key != "default" && $value != "default") {
        if ($value == "other") {
            $value = htmlspecialchars($_POST["otherValue"]);
        }
        try {
            $pdo = null;
            include '../importPhp/pdo.php';
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            switch ($key) {
                case "name":
                    $update = $pdo->prepare("UPDATE coc SET pseudoAccount = :value WHERE pseudoAccount = :name");
                    $update->execute(['value' => $value, 'name' => $name]);
                    break;
                case "hdvMax":
                    $update = $pdo->prepare("UPDATE coc SET hdvMax = :value WHERE pseudoAccount = :name");
                    $update->execute(['value' => $value, 'name' => $name]);
                    break;
                case "actualHdv":
                    $update = $pdo->prepare("UPDATE coc SET actualHdv = :value WHERE pseudoAccount = :name");
                    $update->execute(['value' => $value, 'name' => $name]);
                    break;
                case "mdoMax":
                    $update = $pdo->prepare("UPDATE coc SET mdoMax = :value WHERE pseudoAccount = :name");
                    $update->execute(['value' => $value, 'name' => $name]);
                    break;
                case "actualMdo":
                    $update = $pdo->prepare("UPDATE coc SET actualMdo = :value WHERE pseudoAccount = :name");
                    $update->execute(['value' => $value, 'name' => $name]);
                    break;
                case "email":
                    $update = $pdo->prepare("UPDATE coc SET email = :value WHERE pseudoAccount = :name");
                    $update->execute(['value' => $value, 'name' => $name]);
                    break;
                case "created":
                    $update = $pdo->prepare("UPDATE coc SET created = :value WHERE pseudoAccount = :name");
                    $update->execute(['value' => $value, 'name' => $name]);
                    break;
                case "maxedHdv":
                    $update = $pdo->prepare("UPDATE coc SET maxedHdv = :value WHERE pseudoAccount = :name");
                    $update->execute(['value' => $value, 'name' => $name]);
                    break;
                case "maxedMdo":
                    $update = $pdo->prepare("UPDATE coc SET maxedMdo = :value WHERE pseudoAccount = :name");
                    $update->execute(['value' => $value, 'name' => $name]);
                    break;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $pdo = null;
    }
}
header("location:../page/coc.php");