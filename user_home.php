<?php
// 1. Ambil kata kunci dari URL
$search = isset($_GET['search']) ? $_GET['search'] : '';

// 2. Logika Query: Jika search kosong tampilkan semua, jika ada isi filter berdasarkan nama
if ($search == '') {
    $query = "SELECT * FROM materials ORDER BY id DESC";
} else {
    $search_safe = $app->conn->real_escape_string($search);
    $query = "SELECT * FROM materials WHERE nama_bahan LIKE '%$search_safe%' ORDER BY id DESC";
}

$materials = $app->conn->query($query);

// Fungsi bantuan warna (tetap sama)
function getKodeWarna($warna_db) {
    $warna_db = strtolower(trim($warna_db));
    $kamus = [
        "beige" => "#f5f5dc", "olive" => "#808000", "sycamore" => "#595d44", 
        "black nt" => "#1a1a1a", "coffee" => "#4b3621", "dusty pink" => "#dca3a3",
        "royal benhur" => "#002366", "white netral" => "#ffffff", "pastel green" => "#77dd77",
        "fanta" => "#ff00ff", "baby pink" => "#f4c2c2", "turquise" => "#40e0d0",
        "teal blue" => "#367588", "deep blue" => "#00008b", "sky blue" => "#87ceeb",
        "baby yellow" => "#fffff0", "lemon" => "#fff700", "bubble gum" => "#ffc1cc",
        "irish blue" => "#0080ff", "royal lilac" => "#7851a9", "mint" => "#98ff98",
        "placid blue" => "#87adcd", "misty 71" => "#dcdcdc", "black" => "#1a1a1a",
        "white" => "#ffffff", "navy" => "#000080", "maroon" => "#800000"
    ];
    return $kamus[$warna_db] ?? "#bdc3c7";
}
?>

<style>
    /* Styling tetap sama seperti kodinganmu sebelumnya */
    .main-wrapper { display: flex; background: #fff; border-radius: 4px; overflow: hidden; border: 1px solid #ddd; min-height: 80vh; }
    .sidebar-kain { width: 250px; background: #f9f9f9; border-right: 2px solid #ddd; flex-shrink: 0; }
    .content-kain { flex-grow: 1; padding: 20px; }
    .nav-kategori .nav-link { color: #222 !important; padding: 12px 20px; border-bottom: 1px solid #eee; font-size: 12px; font-weight: 700; text-transform: uppercase; }
    .nav-kategori .nav-link.active { color: #cc0000 !important; background: #fff; border-right: 4px solid #cc0000; }
    .card-kain { border: 1px solid #eee; border-radius: 8px; transition: 0.3s; height: 100%; display: flex; flex-direction: column; }
    .card-kain:hover { border-color: #cc0000; transform: translateY(-5px); }
    .harga-box { color: #cc0000; font-weight: 800; font-size: 17px; }
    .btn-beli { background: #d00000; color: white; border: none; width: 100%; padding: 8px; font-weight: bold; border-radius: 4px; text-align: center; text-decoration: none; margin-top: auto; display: block; }
</style>

<div class="main-wrapper">
    <div class="sidebar-kain d-none d-md-block">
        <div class="sidebar-header p-3 fw-bold border-bottom">JENIS KAIN</div>
        <nav class="nav flex-column nav-kategori">
            <a class="nav-link <?= $search == '' ? 'active' : '' ?>" href="index.php?url=user_home">▶ SEMUA PRODUK</a>
            <a class="nav-link <?= $search == 'Australia' ? 'active' : '' ?>" href="index.php?url=user_home&search=Australia">COTTON AUSTRALIA</a>
            <a class="nav-link <?= $search == 'Japan' ? 'active' : '' ?>" href="index.php?url=user_home&search=Japan">COTTON JAPAN</a>
            <a class="nav-link <?= $search == 'Combed' ? 'active' : '' ?>" href="index.php?url=user_home&search=Combed">COMBED BCI</a>
            <a class="nav-link <?= $search == 'Fleece' ? 'active' : '' ?>" href="index.php?url=user_home&search=Fleece">COTTON FLEECE</a>
        </nav>
    </div>

    <div class="content-kain">
        <h5 class="fw-bold mb-4 text-uppercase">Katalog: <?= $search ? $search : 'SEMUA PRODUK' ?></h5>
        
        <div class="row row-cols-2 row-cols-lg-4 g-4">
            <?php if ($materials && $materials->num_rows > 0): ?>
                <?php while($m = $materials->fetch_assoc()): ?>
                    <div class="col">
                        <div class="card-kain shadow-sm p-2">
                            <div class="img-box rounded mb-2" style="background-color: <?= getKodeWarna($m['warna']) ?>; height: 150px; position: relative;">
                                <div style="position: absolute; width:100%; height:100%; background: url('https://www.transparenttextures.com/patterns/fabric.png'); opacity:0.1;"></div>
                            </div>
                            <div class="info-box flex-grow-1">
                                <small class="text-muted fw-bold"><?= strtoupper($m['warna']) ?></small>
                                <div class="fw-bold mb-1" style="font-size: 13px; line-height: 1.2; height: 32px; overflow: hidden;"><?= $m['nama_bahan'] ?></div>
                                <div class="small text-muted mb-2"><?= $m['ketebalan'] ?> GSM</div>
                                <div class="harga-box mb-2">Rp<?= number_format($m['harga'], 0,',','.') ?></div>
                                <a href="index.php?url=beli_detail&id=<?= $m['id'] ?>" class="btn-beli">BELI</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="bi bi-search text-muted" style="font-size: 3rem;"></i>
                    <p class="mt-3 text-muted">Produk "<?= $search ?>" tidak ditemukan.</p>
                    <a href="index.php?url=user_home" class="btn btn-sm btn-outline-danger">Lihat Semua Produk</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>