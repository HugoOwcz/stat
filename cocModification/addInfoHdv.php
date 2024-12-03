<?php
session_start();
$hdvOrMdo = "Hdv";
$level = "0";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hdvOrMdo = htmlspecialchars($_POST["hdvOrMdo"]);
    $level = htmlspecialchars($_POST["level"]);
    $buildingName = htmlspecialchars($_POST["buildingName"]);
    $copies = htmlspecialchars($_POST["copies"]);
    $type = htmlspecialchars($_POST["type"]);
    $maxLevel = htmlspecialchars($_POST["maxLevel"]);
    if ($hdvOrMdo != " " && $level != " " && $copies != '' && $buildingName != '' && $type != '') {
        try {
            $pdo = null;
            include 'pdo.php';
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $add = $pdo->prepare("INSERT INTO buildingsinfoforhdvmdo (HdvOrMdo, levelHdvMdo, buildings, maxLevel, nbBuildings, type) VALUES (:HdvOrMdo, :levelHdvMdo, :buildings, :maxLevel , :nbBuildings, :type)");
            $add->execute(['HdvOrMdo' => $hdvOrMdo, 'levelHdvMdo' => $level, 'buildings' => $buildingName, 'maxLevel' => $maxLevel , 'nbBuildings' => $copies, 'type' => $type]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
header("location:../infoHdvMdo.php?".$hdvOrMdo."-".$level);