<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_SESSION['info'] == "Show") {
        $_SESSION['info'] = "Hide";
    } else {
        $_SESSION['info'] = "Show";
    }
    echo $_SESSION['info'];
}
header('location:../page/'.$_SESSION['location']);
