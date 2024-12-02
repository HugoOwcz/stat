<?php
session_start();
$hdv = "0";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hdv = htmlspecialchars($_POST["hdv"]);
    $buildingName = htmlspecialchars($_POST["buildingName"]);
    $copies = htmlspecialchars($_POST["copies"]);
    $type = htmlspecialchars($_POST["type"]);
    $maxLevel = htmlspecialchars($_POST["maxLevel"]);
    if ($hdv != '' and $copies != '' and $buildingName != '' and $type != '') {
        try {
            $pdo = null;
            include 'pdo.php';
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $add = $pdo->prepare("INSERT INTO hdvinfo (hdv, buildings, maxLevel, nbBuildings, type) VALUES (:hdv, :buildings, :maxLevel , :nbBuildings, :type)");
            $add->execute(['hdv' => $hdv, 'buildings' => $buildingName, 'maxLevel' => $maxLevel , 'nbBuildings' => $copies, 'type' => $type]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
header("location:../infoHdv.php?".$hdv);