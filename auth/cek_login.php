<?php
session_start();
include '../config/koneksi.php';

$user = mysqli_real_escape_string($koneksi, $_POST['username']);
$pass = md5($_POST['password']); 

$q = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$user' AND password='$pass'");

if (mysqli_num_rows($q) > 0) {
    $data = mysqli_fetch_assoc($q);
    $_SESSION['login'] = true;
    $_SESSION['username'] = $data['username']; // Baris ini wajib ada agar dashboard tidak error
    header("location:../dashboard.php");
} else {
    echo "<script>alert('Login Gagal!'); window.location='login.php';</script>";
}
?>