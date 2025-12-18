<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['login'])){
    header("location:../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>SPK WP</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="wrapper">
