<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id     = $_SESSION['user_id'];
    $material_id = $_POST['material_id'];
    $jumlah      = $_POST['jumlah'];
    $ketebalan   = $_POST['ketebalan'];

    // Ambil harga asli dari DB
    $res = $app->conn->query("SELECT harga, stok FROM materials WHERE id = $material_id");
    $data = $res->fetch_assoc();
    
    $total_harga = $data['harga'] * $jumlah;

    // 1. Simpan ke tabel orders (Termasuk ketebalan dan tgl_pesan)
    $q_order = "INSERT INTO orders (user_id, material_id, jumlah_beli, ketebalan_beli, total_harga, tgl_pesan, status) 
                VALUES ('$user_id', '$material_id', '$jumlah', '$ketebalan', '$total_harga', NOW(), 'Selesai')";
    
    if ($app->conn->query($q_order)) {
        // 2. Kurangi stok bahan di gudang
        $app->conn->query("UPDATE materials SET stok = stok - $jumlah WHERE id = $material_id");
        
        echo "<script>alert('Pesanan berhasil dibuat!'); window.location='index.php?url=pesanan_saya';</script>";
    } else {
        echo "<script>alert('Gagal memproses: " . $app->conn->error . "'); window.location='index.php?url=user_home';</script>";
    }
}
?>