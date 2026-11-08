<?php session_start(); include 'config/koneksi.php'; if($_SESSION['role'] != 'admin'){ exit; }
$judul = $_POST['judul']; $kategori = $_POST['kategori']; $penulis = $_POST['penulis'];
$tahun = $_POST['tahun_terbit']; $stok = (int)$_POST['stok'];
$status = ($stok > 0) ? "Tersedia" : "Dipinjam";
$rand = rand(); $ext = strtolower(pathinfo($_FILES['sampul']['name'], PATHINFO_EXTENSION));
if(!in_array($ext, array('png','jpg','jpeg'))) { header("location:dashboard.php?alert=gagal_ekstensi"); } else {
    if($_FILES['sampul']['size'] < 2097152){
        $sampul = $rand.'_'.$_FILES['sampul']['name']; move_uploaded_file($_FILES['sampul']['tmp_name'], 'uploads/'.$sampul);
        mysqli_query($conn, "INSERT INTO buku (judul, kategori, penulis, tahun_terbit, stok, status_ketersediaan, sampul) VALUES ('$judul','$kategori','$penulis','$tahun','$stok','$status','$sampul')");
        header("location:dashboard.php?alert=berhasil");
    } else { header("location:dashboard.php?alert=gagal_ukuran"); }
} ?>