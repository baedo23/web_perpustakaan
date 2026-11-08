<?php session_start();
if(isset($_COOKIE['remember_user'])) { $_SESSION['username'] = $_COOKIE['remember_user']; $_SESSION['status'] = "login"; }
if(isset($_SESSION['status']) && $_SESSION['status'] == "login"){ header("location:dashboard.php"); exit; }
?>
<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><title>Login - Digital Library</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"><link href="assets/css/style.css" rel="stylesheet"></head>
<body class="login-bg d-flex align-items-center" style="height: 100vh;">
<div class="container"><div class="row justify-content-center"><div class="col-md-4"><div class="card p-4"><div class="card-body">
<h3 class="fw-bold mt-2 text-center" style="color:#2b2b2b;">Digital Library</h3><hr>
<form action="proses_login.php" method="POST"><div class="mb-3"><label>Username</label><input type="text" name="username" class="form-control" required autofocus></div><div class="mb-3"><label>Password</label><input type="password" name="password" class="form-control" required></div><button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm">Masuk</button></form>
</div></div></div></div></div></body></html>