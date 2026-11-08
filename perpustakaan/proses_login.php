<?php
session_start(); include 'config/koneksi.php';
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = md5($_POST['password']); 
$data = mysqli_query($conn,"SELECT * FROM users WHERE username='$username' AND password='$password'");
if(mysqli_num_rows($data) > 0){
    $user = mysqli_fetch_assoc($data);
    $_SESSION['username'] = $user['username']; 
    $_SESSION['role'] = $user['role']; // Simpan Hak Akses
    $_SESSION['status'] = "login";
    if(isset($_POST['remember'])) setcookie('remember_user', $username, time() + (86400 * 30), "/");
    header("location:dashboard.php");
} else { header("location:index.php?pesan=gagal"); }
?>