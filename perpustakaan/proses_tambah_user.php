<?php
session_start(); include 'config/koneksi.php';
if($_SESSION['role'] != 'admin') { header("location:dashboard.php"); exit; }
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = md5($_POST['password']); 
$role = $_POST['role'];
if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE username='$username'")) > 0){
    header("location:tambah_user.php?alert=username_ada"); exit;
}
mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')");
header("location:dashboard.php?alert=berhasil");
?>