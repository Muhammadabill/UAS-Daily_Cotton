<?php
// 1. Ambil data dari form POST
$material_id  = $_POST['id_material'] ?? 0; 
$nama_bahan   = $_POST['nama_bahan'] ?? 'Kain Cotton';
$warna        = $_POST['warna'] ?? '-';
$jumlah       = $_POST['jumlah'] ?? 0;
$metode       = $_POST['metode'] ?? 'QRIS';
$harga_satuan = $_POST['harga_satuan'] ?? 0;
$ketebalan    = $_POST['ketebalan'] ?? '-';
$total        = $harga_satuan * $jumlah;

// 2. Ambil User ID dari Session
$uid = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
$tgl_sekarang = date('Y-m-d H:i:s');

$is_saved = false;

// 3. PROSES SIMPAN KE DATABASE
if ($uid > 0 && $material_id > 0 && $jumlah > 0) {
    $sql = "INSERT INTO orders (user_id, material_id, ketebalan_beli, jumlah_beli, total_harga, tgl_pesan, metode_bayar) 
            VALUES ('$uid', '$material_id', '$ketebalan', '$jumlah', '$total', '$tgl_sekarang', '$metode')";
    
    if ($app->conn->query($sql)) {
        $is_saved = true;
    } else {
        echo "<div class='alert alert-danger m-3'>Gagal simpan database: " . $app->conn->error . "</div>";
    }
} else {
    echo "<div class='alert alert-warning m-3'>Error: Data tidak lengkap atau Anda belum login!</div>";
}
?>

<?php if ($is_saved): ?>
<div class="container my-4 d-flex justify-content-center">
    <div class="card shadow-sm" style="width: 350px; border: 1px dashed #bbb; border-radius: 0;">
        <div class="card-body p-4 text-center">
            <h5 class="fw-bold mb-0">DAILY COTTON</h5>
            <small class="text-muted">Invoice: #DC-<?= rand(1000, 9999) ?></small>
            <hr>
            <div class="text-start small">
                <div class="d-flex justify-content-between mb-1">
                    <span>Produk:</span> <span class="fw-bold"><?= $nama_bahan ?></span>
                </div>
                <div class="d-flex justify-content-between mb-1">
                    <span>Warna:</span> <span class="fw-bold"><?= $warna ?></span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span>Total:</span> <span class="fw-bold text-danger">Rp<?= number_format($total, 0, ',', '.') ?></span>
                </div>
            </div>
            
            <div class="mt-4 p-2 bg-light rounded border border-success">
                <small class="text-success fw-bold"><i class="bi bi-check-circle-fill"></i> PEMBAYARAN BERHASIL</small>
            </div>

            <div class="mt-3 d-grid gap-2 no-print">
                <button onclick="window.print()" class="btn btn-sm btn-outline-dark">Cetak Struk</button>
                <a href="index.php?url=pesanan_saya" class="btn btn-sm btn-danger text-white">Cek Riwayat Belanja</a>
                <a href="index.php?url=user_home" class="btn btn-sm btn-link text-decoration-none text-muted small">Kembali ke Katalog</a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>