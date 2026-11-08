<?php session_start(); include 'config/koneksi.php'; if($_SESSION['role'] != 'admin'){ exit; }
$id = $_POST['id']; $judul = $_POST['judul']; $kategori = $_POST['kategori'];
$penulis = $_POST['penulis']; $tahun = $_POST['tahun_terbit']; $stok = (int)$_POST['stok'];
$status = ($stok > 0) ? "Tersedia" : "Dipinjam"; $nama_file = $_FILES['sampul']['name'];
if($nama_file != ""){
    $ext = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
    if(in_array($ext, array('png','jpg','jpeg')) && $_FILES['sampul']['size'] < 2097152){
        $data = mysqli_fetch_array(mysqli_query($conn,"SELECT sampul FROM buku WHERE id='$id'"));
        if(file_exists("uploads/".$data['sampul'])) unlink("uploads/".$data['sampul']);
        $sampul = rand().'_'.$nama_file; move_uploaded_file($_FILES['sampul']['tmp_name'], 'uploads/'.$sampul);
        mysqli_query($conn, "UPDATE buku SET judul='$judul', kategori='$kategori', penulis='$penulis', tahun_terbit='$tahun', stok='$stok', status_ketersediaan='$status', sampul='$sampul' WHERE id='$id'");
    }
} else { mysqli_query($conn, "UPDATE buku SET judul='$judul', kategori='$kategori', penulis='$penulis', tahun_terbit='$tahun', stok='$stok', status_ketersediaan='$status' WHERE id='$id'"); }
header("location:dashboard.php?alert=berhasil");
?>