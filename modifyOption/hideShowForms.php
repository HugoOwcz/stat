<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_SESSION['forms'] == "Show") {
        $_SESSION['forms'] = "Hide";
    } else {
        $_SESSION['forms'] = "Show";
    }
    echo $_SESSION['forms'];
}
header('location:../page/'.$_SESSION['location']);