<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: login.html");
    exit();
}
header("Location: homepage.html?user=" . urlencode($_SESSION['user_name']) . "&email=" . urlencode($_SESSION['user_email']));
exit();
?>
