<?php
session_start(); include 'config/koneksi.php';
if($_SESSION['role'] != 'admin'){ header("location:dashboard.php"); exit; }
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sampul FROM buku WHERE id='$id'"));
if(file_exists("uploads/".$data['sampul'])) unlink("uploads/".$data['sampul']);
mysqli_query($conn,"DELETE FROM buku WHERE id='$id'");
header("location:dashboard.php?alert=berhasil");
?>