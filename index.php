<?php
session_start();
require_once 'app/Controller.php';
$app = new Controller();

$url = isset($_GET['url']) ? trim($_GET['url']) : 'login';

// Halaman yang bisa diakses tanpa login
$halaman_terbuka = ['login', 'proses_login', 'register', 'proses_register'];

if (!isset($_SESSION['login']) && !in_array($url, $halaman_terbuka)) {
    header("Location: index.php?url=login");
    exit;
}

// Routing Dashboard Admin
$view_file = $url;
if ($url == 'admin_dashboard') {
    $view_file = 'admin_home';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Cotton - <?= ucfirst(str_replace('_', ' ', $url)) ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Roboto, sans-serif; }
        .navbar-custom { 
            background-color: #1a1a1a; 
            padding: 12px 0; 
            border-bottom: 3px solid <?= (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') ? '#0dcaf0' : '#cc0000' ?>; 
        }
        /* Jarak atas hanya muncul jika BUKAN halaman login/register */
        .container-main { margin-top: 25px; padding-bottom: 50px; }
        .nav-link { font-size: 0.9rem; transition: 0.3s; color: rgba(255,255,255,0.7) !important; font-weight: 500; }
        .nav-link:hover, .nav-link.active { color: #fff !important; }
        .card { border-radius: 12px; border: none; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); }
    </style>
</head>
<body>

<?php 
// MODIFIKASI: Navbar hanya muncul jika user sudah login DAN tidak sedang di halaman login/register
if (isset($_SESSION['login']) && !in_array($url, $halaman_terbuka)): 
?>
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php?url=<?= ($_SESSION['role'] == 'admin') ? 'admin_dashboard' : 'user_home' ?>">
            DAILY COTTON
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <?php if ($_SESSION['role'] == 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($url == 'admin_dashboard') ? 'active fw-bold text-info' : '' ?>" href="index.php?url=admin_dashboard">
                            <i class="bi bi-speedometer2"></i> DASHBOARD
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($url == 'data_pelanggan') ? 'active fw-bold text-info' : '' ?>" href="index.php?url=data_pelanggan">
                            <i class="bi bi-people"></i> DATA PELANGGAN
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($url == 'user_home') ? 'active fw-bold' : '' ?>" href="index.php?url=user_home">
                            <i class="bi bi-shop"></i> KATALOG PRODUK
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($url == 'pesanan_saya') ? 'active fw-bold' : '' ?>" href="index.php?url=pesanan_saya">
                            <i class="bi bi-receipt"></i> PESANAN SAYA
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item d-flex align-items-center me-3">
                    <span class="badge bg-dark border border-secondary px-3 py-2">
                        <i class="bi bi-person-circle me-1"></i> <?= strtoupper($_SESSION['username'] ?? '') ?>
                    </span>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-danger btn-sm px-3" href="index.php?url=logout">KELUAR</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php endif; ?>

<div class="<?= in_array($url, $halaman_terbuka) ? '' : 'container container-main' ?>">
    <?php
    // --- 1. PROSES LOGIKA ---
    
    if ($url == 'proses_login') {
        $u = $app->conn->real_escape_string($_POST['username']);
        $p = $_POST['password']; 
        if ($app->login($u, $p)) {
            $target = ($_SESSION['role'] == 'admin') ? 'admin_dashboard' : 'user_home';
            header("Location: index.php?url=$target"); exit;
        } else {
            echo "<script>alert('Login Gagal!'); window.location='index.php?url=login';</script>";
        }

    } elseif ($url == 'proses_register') {
        $nama = $app->conn->real_escape_string($_POST['nama']);
        $username = $app->conn->real_escape_string($_POST['username']);
        $password = $_POST['password']; 
        $cek = $app->conn->query("SELECT * FROM users WHERE username = '$username'");
        if($cek->num_rows > 0) {
            echo "<script>alert('Username sudah ada!'); window.location='index.php?url=register';</script>";
        } else {
            $sql = "INSERT INTO users (nama, username, password, role) VALUES ('$nama', '$username', '$password', 'user')";
            if($app->conn->query($sql)) {
                echo "<script>alert('Berhasil! Silakan Login.'); window.location='index.php?url=login';</script>";
            }
        }

    } elseif ($url == 'proses_tambah_material') {
        $nama  = $app->conn->real_escape_string($_POST['nama_bahan']);
        $warna = $app->conn->real_escape_string($_POST['warna']);
        $gsm   = $app->conn->real_escape_string($_POST['ketebalan']) . " GSM";
        $stok  = (int)$_POST['stok'];
        $harga = (int)$_POST['harga'];
        
        $sql = "INSERT INTO materials (nama_bahan, warna, ketebalan, stok, harga) VALUES ('$nama', '$warna', '$gsm', '$stok', '$harga')";
        if($app->conn->query($sql)) {
            header("Location: index.php?url=admin_dashboard&msg=sukses_tambah"); exit;
        }

    } elseif ($url == 'proses_update_material') {
        $id    = (int)$_POST['id'];
        $nama  = $app->conn->real_escape_string($_POST['nama_bahan']);
        $warna = $app->conn->real_escape_string($_POST['warna']);
        $stok  = (int)$_POST['stok'];
        $harga = (int)$_POST['harga'];
        
        $sql = "UPDATE materials SET nama_bahan='$nama', warna='$warna', stok='$stok', harga='$harga' WHERE id=$id";
        if($app->conn->query($sql)) {
            header("Location: index.php?url=admin_dashboard&msg=sukses_update"); exit;
        }

    } elseif ($url == 'hapus_material') {
        $id = (int)$_GET['id'];
        if($app->conn->query("DELETE FROM materials WHERE id = $id")) {
            header("Location: index.php?url=admin_dashboard&msg=sukses_hapus"); exit;
        }

    } elseif ($url == 'logout') {
        session_destroy();
        header("Location: index.php?url=login"); exit;
        
    } else {
        // --- 2. LOAD VIEW FILE ---
        $file = "views/" . $view_file . ".php";
        if (file_exists($file)) {
            include $file;
        } else {
            echo "<div class='text-center py-5'>
                    <i class='bi bi-exclamation-triangle text-warning' style='font-size: 3rem;'></i>
                    <h4 class='mt-3'>Halaman '$url' tidak ditemukan.</h4>
                    <p class='text-muted small'>Pastikan file '$file' sudah ada di folder views.</p>
                    <a href='index.php' class='btn btn-primary btn-sm'>Kembali ke Home</a>
                  </div>";
        }
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>