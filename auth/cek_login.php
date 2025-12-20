<?php
session_start();
include '../config/koneksi.php';


$user = $_POST['username'];
$pass = md5($_POST['password']);


$q = mysqli_query($koneksi,"SELECT * FROM user WHERE username='$user' AND password='$pass'");
if(mysqli_num_rows($q)>0){
$_SESSION['login']=true;
header("location:../pages/kriteria.php");
}else{
echo "Login gagal";
}
?>