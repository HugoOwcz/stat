<?php
session_start();
$hdvOrMdo = "Hdv";
$level = "0";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hdvOrMdo = htmlspecialchars($_POST["hdvOrMdo"]);
    $level = htmlspecialchars($_POST["level"]);
    $name = htmlspecialchars($_POST["name"]);
    if ($hdvOrMdo != " " && $level != " " && $name != "default") {
        try {
            $pdo = null;
            include '../importPhp/pdo.php';
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $delete = $pdo->prepare("DELETE FROM buildingsinfoforhdvmdo WHERE HdvOrMdo = :hdvorMdo AND levelHdvMdo = :levelHdvMdo AND buildings = :name");
            $delete->execute(['hdvorMdo' => $hdvOrMdo, 'levelHdvMdo' => $level, 'name' => $name]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $pdo = null;
    }
}
header("location:../page/infoHdvMdo.php?".$hdvOrMdo."-".$level);