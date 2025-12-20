<?php
session_start();
if(!isset($_SESSION['login'])){
header("location:auth/login.php");
}else{
header("location:auth/login.php");
}
?>