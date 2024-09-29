<?php
session_start();
unset($_SESSION['ADMIN_LOGIN']);
unset($_SESSION['ADMIN_USERNAME']);
unset($_SESSION['ADMIN_PASSWORD']);
header('location:login.php');
die();
?>