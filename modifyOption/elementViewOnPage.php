<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['viewOption'] = htmlspecialchars($_POST['option']);
}
header('location:../page/'.$_SESSION['location']);
