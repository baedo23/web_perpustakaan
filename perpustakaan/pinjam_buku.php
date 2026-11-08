<?php
session_start();
if(!isset($_SESSION['status']) || $_SESSION['role'] != 'user'){ header("location:index.php"); exit; }
include 'config/koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT stok FROM buku WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if($data['stok'] > 0){
    $stok_baru = $data['stok'] - 1;
    $status = ($stok_baru > 0) ? "Tersedia" : "Dipinjam";
    mysqli_query($conn, "UPDATE buku SET stok='$stok_baru', status_ketersediaan='$status' WHERE id='$id'");
    header("location:dashboard.php?alert=pinjam_sukses");
} else {
    header("location:dashboard.php?alert=pinjam_gagal");
}
?>