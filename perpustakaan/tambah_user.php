<?php 
session_start(); 
if(!isset($_SESSION['status']) || $_SESSION['role'] != 'admin'){ header("location:dashboard.php"); exit; } 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah User - Digital Library</title>
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-white pt-4 pb-2 border-0">
                        <h4 class="fw-bold mb-0"><i class="bi bi-person-plus text-success me-2"></i> Tambah Pengguna</h4>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <?php if(isset($_GET['alert']) && $_GET['alert']=='username_ada'){ echo '<div class="alert alert-danger"><i class="bi bi-x-circle-fill me-2"></i> Username sudah digunakan.</div>'; } ?>
                        <form action="proses_tambah_user.php" method="POST">
                            <div class="mb-3">
                                <label>Username Baru</label>
                                <input type="text" name="username" class="form-control form-control-lg fs-6" required placeholder="Masukkan username unik">
                            </div>
                            <div class="mb-3">
                                <label>Password Akun</label>
                                <input type="password" name="password" class="form-control" required placeholder="Buat password yang kuat">
                            </div>
                            <div class="mb-4">
                                <label>Hak Akses (Role)</label>
                                <select name="role" class="form-select" required>
                                    <option value="user">User Biasa (Hanya Meminjam)</option>
                                    <option value="admin">Administrator (Kelola Buku)</option>
                                </select>
                            </div>
                            <hr class="text-muted opacity-25">
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-success px-4"><i class="bi bi-person-check me-1"></i> Simpan User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>