<?php
session_start();
$hdv = "0";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hdv = htmlspecialchars($_POST["hdv"]);
    $name = htmlspecialchars($_POST["name"]);
    if ($hdv != "" && $name != "default") {
        try {
            $pdo = null;
            include 'pdo.php';
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $delete = $pdo->prepare("DELETE FROM hdvinfo WHERE hdv = :hdv AND buildings = :name");
            $delete->execute(['hdv' => $hdv, 'name' => $name]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $pdo = null;
    }
}
header("location:../infoHdv.php?".$hdv);