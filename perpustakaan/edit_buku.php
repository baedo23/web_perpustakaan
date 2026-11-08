<?php
session_start(); if(!isset($_SESSION['status']) || $_SESSION['role']!='admin'){ header("location:dashboard.php"); exit; }
include 'config/koneksi.php';
$id = $_GET['id'];
$d = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM buku WHERE id='$id'"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku - Digital Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom mb-5">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php"><i class="bi bi-book-half me-2"></i>Perpustakaan Digital</a>
            <a href="dashboard.php" class="btn btn-light btn-sm fw-bold text-secondary"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-white pt-4 pb-2 border-0">
                        <h4 class="fw-bold mb-0"><i class="bi bi-pencil-square text-warning me-2"></i> Edit Data Buku</h4>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <form action="proses_edit.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $d['id']; ?>">
                            <div class="mb-3">
                                <label>Judul Buku</label>
                                <input type="text" name="judul" class="form-control form-control-lg fs-6" value="<?php echo $d['judul']; ?>" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Kategori</label>
                                    <input type="text" name="kategori" class="form-control" value="<?php echo $d['kategori']; ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Penulis</label>
                                    <input type="text" name="penulis" class="form-control" value="<?php echo $d['penulis']; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Tahun Terbit</label>
                                    <input type="number" name="tahun_terbit" class="form-control" value="<?php echo $d['tahun_terbit']; ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Stok Buku</label>
                                    <input type="number" name="stok" class="form-control" value="<?php echo $d['stok']; ?>" required min="0">
                                </div>
                            </div>
                            <div class="mb-4 bg-light p-3 rounded-3 border">
                                <div class="d-flex align-items-center">
                                    <img src="uploads/<?php echo $d['sampul']; ?>" class="rounded shadow-sm me-3" style="width: 60px; height: 85px; object-fit: cover;">
                                    <div class="flex-grow-1">
                                        <label class="mb-1 text-dark">Ganti Sampul Baru (Opsional)</label>
                                        <input type="file" name="sampul" class="form-control form-control-sm" accept=".jpg,.jpeg,.png">
                                    </div>
                                </div>
                            </div>
                            <hr class="text-muted opacity-25">
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-warning text-dark px-4"><i class="bi bi-cloud-arrow-up me-1"></i> Update Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>