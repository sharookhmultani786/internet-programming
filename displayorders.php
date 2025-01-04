<?php
session_start();

if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}
header("Location: Orders.html?user=" . urlencode($_SESSION['user_name']) . "&email=" . urlencode($_SESSION['user_email']));
exit();
?>