<?php
session_start();
if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){ header("location:index.php?pesan=belum_login"); exit; }
include 'config/koneksi.php';
$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Digital Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom mb-5">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php"><i class="bi bi-book-half me-2"></i>Perpustakaan Digital</a>
            <div class="d-flex align-items-center">
                <span class="me-4 fw-medium text-secondary">
                    <i class="bi bi-person-circle me-1"></i> Halo, <?php echo $_SESSION['username']; ?> <span class="badge <?php echo ($role=='admin')?'bg-primary':'bg-secondary'; ?> ms-1"><?php echo strtoupper($role); ?></span>
                </span>
                <a href="logout.php" class="btn btn-light btn-sm text-danger border-0 bg-transparent fw-bold" onclick="return confirm('Yakin ingin keluar?')">
                    <i class="bi bi-box-arrow-right me-1"></i> Keluar
                </a>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h4 class="fw-bold mb-1" style="color: #2b2b2b;">Daftar Buku</h4>
                <p class="text-muted mb-0">Koleksi buku perpustakaan digital kami</p>
            </div>
            <?php if($role == 'admin'){ ?>
            <div>
                <a href="tambah_user.php" class="btn btn-light shadow-sm text-secondary me-2 px-3"><i class="bi bi-person-plus me-1"></i> User</a>
                <a href="tambah_buku.php" class="btn btn-primary shadow-sm px-4"><i class="bi bi-plus-lg me-1"></i> Tambah Buku</a>
            </div>
            <?php } ?>
        </div>

        <?php if(isset($_GET['alert'])){
            if($_GET['alert']=='berhasil'){ echo '<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3"><i class="bi bi-check-circle-fill me-2"></i> Data berhasil diperbarui! <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>'; }
            else if($_GET['alert']=='pinjam_sukses'){ echo '<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3"><i class="bi bi-journal-check me-2"></i> Buku berhasil dipinjam. Silakan ambil di meja petugas! <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>'; }
            else if($_GET['alert']=='pinjam_gagal'){ echo '<div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3"><i class="bi bi-exclamation-octagon-fill me-2"></i> Gagal! Stok buku sedang habis. <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>'; }
        } ?>

        <div class="table-wrapper">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th width="10%">Sampul</th>
                        <th width="25%">Judul Buku</th>
                        <th width="15%">Kategori</th>
                        <th width="15%">Penulis</th>
                        <th class="text-center" width="10%">Tahun</th>
                        <th class="text-center" width="10%">Status</th>
                        <th class="text-center" width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    $data = mysqli_query($conn,"SELECT * FROM buku ORDER BY id DESC");
                    while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                        <td class="text-center text-muted"><?php echo $no++; ?></td>
                        <td>
                            <div style="width: 55px; height: 75px; border-radius: 8px; overflow: hidden; box-shadow: 0 3px 6px rgba(0,0,0,0.1);">
                                <img src="uploads/<?php echo $d['sampul']; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </td>
                        <td><span class="fw-bold d-block" style="color: #333; font-size: 1.05rem;"><?php echo $d['judul']; ?></span></td>
                        <td><span class="text-muted"><i class="bi bi-tag-fill me-1" style="color: #e0e0e0;"></i><?php echo $d['kategori']; ?></span></td>
                        <td><span class="text-secondary"><?php echo $d['penulis']; ?></span></td>
                        <td class="text-center fw-medium"><?php echo $d['tahun_terbit']; ?></td>
                        <td class="text-center">
                            <?php 
                            if($d['status_ketersediaan'] == 'Tersedia'){ echo '<span class="badge bg-soft-success">Tersedia ('.$d['stok'].')</span>'; }
                            else{ echo '<span class="badge bg-soft-danger">Dipinjam</span>'; }
                            ?>
                        </td>
                        <td class="text-center">
                            <?php if($role == 'admin'){ ?>
                                <a href="edit_buku.php?id=<?php echo $d['id']; ?>" class="btn btn-sm btn-light text-primary shadow-sm me-1" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                <a href="hapus_buku.php?id=<?php echo $d['id']; ?>" class="btn btn-sm btn-light text-danger shadow-sm" onclick="return confirm('Hapus buku ini?')" title="Hapus"><i class="bi bi-trash"></i></a>
                            <?php } else { ?>
                                <?php if($d['stok'] > 0){ ?>
                                    <a href="pinjam_buku.php?id=<?php echo $d['id']; ?>" class="btn btn-sm btn-primary shadow-sm px-3" onclick="return confirm('Yakin ingin meminjam buku ini?')"><i class="bi bi-journal-arrow-down me-1"></i> Pinjam</a>
                                <?php } else { ?>
                                    <button class="btn btn-sm btn-secondary shadow-sm px-3" disabled>Habis</button>
                                <?php } ?>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>