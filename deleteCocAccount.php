<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    if ($name != "default") {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=stat_perso', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $delete = $pdo->prepare("DELETE FROM coc WHERE pseudoAccount = :name");
            $delete->bindParam(':name', $name);
            $delete->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $pdo = null;
    }
}
header("location:coc.php");