<?php
session_start();
if ($_SESSION['forms'] == "Show") {
    $_SESSION['forms'] = "Hide";
} else {
    $_SESSION['forms'] = "Show";
}
echo $_SESSION['forms'];
header('location:../page/'.$_SESSION['location']);