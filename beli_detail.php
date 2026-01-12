<?php
// 1. Ambil ID dari URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// 2. Ambil data dari database
$res = $app->conn->query("SELECT * FROM materials WHERE id = $id");

// 3. Masukkan ke variabel $m dan pastikan data ada
if ($res && $res->num_rows > 0) {
    $m = $res->fetch_assoc();
} else {
    echo "<div class='alert alert-danger'>Produk tidak ditemukan atau ID salah!</div>";
    exit;
}

// Fungsi bantuan untuk ambil kode warna
function getKodeWarnaDetail($warna_db) {
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

<div class="row justify-content-center">
    <div class="col-md-11">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <div class="row g-3">
                    <div class="col-md-4 text-center rounded d-flex flex-column align-items-center justify-content-center" 
                         style="background-color: <?= getKodeWarnaDetail($m['warna']) ?>; min-height: 250px; position: relative;">
                        <div style="position: absolute; top:0; left:0; width:100%; height:100%; background: url('https://www.transparenttextures.com/patterns/fabric.png'); opacity: 0.1;"></div>
                        <i class="bi bi-box-seam text-white opacity-50 mb-2" style="font-size: 3rem;"></i>
                        <h4 class="fw-bold text-white text-uppercase m-0" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.3)"><?= $m['warna'] ?></h4>
                    </div>
                    
                    <div class="col-md-8">
                        <h4 class="fw-bold text-uppercase mb-1"><?= $m['nama_bahan'] ?></h4>
                        <p class="text-danger fw-bold mb-2">Rp<?= number_format($m['harga'], 0,',','.') ?> /kg</p>
                        
                        <form action="index.php?url=proses_bayar" method="POST">
                            <input type="hidden" name="id_material" value="<?= $m['id'] ?>">
                            <input type="hidden" name="nama_bahan" value="<?= $m['nama_bahan'] ?>">
                            <input type="hidden" name="warna" value="<?= $m['warna'] ?>">
                            <input type="hidden" id="harga_satuan" name="harga_satuan" value="<?= $m['harga'] ?>">

                            <div class="row g-2">
                                <div class="col-md-6 mb-2">
                                    <label class="small fw-bold text-muted text-uppercase">Ketebalan</label>
                                    <select name="ketebalan" class="form-select form-select-sm" required>
                                        <option value="<?= $m['ketebalan'] ?>"><?= $m['ketebalan'] ?> GSM</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="small fw-bold text-muted text-uppercase">Jumlah (Kg)</label>
                                    <input type="number" id="input_jumlah" name="jumlah" class="form-control form-control-sm" 
                                           step="0.01" min="1.5" placeholder="Minimal 1.50" required oninput="hitungTotal()">
                                    <div style="font-size: 10px;" class="text-danger fw-bold mt-1">* Minimal pembelian 1.5 kg</div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center bg-dark text-white p-2 rounded mb-2">
                                <small class="fw-bold">ESTIMASI TOTAL:</small>
                                <span class="fw-bold" id="display_total">Rp0</span>
                            </div>

                            <div class="bg-light p-2 rounded mb-3 border text-center">
                                <label class="small fw-bold mb-1 d-block text-muted text-uppercase">Metode Pembayaran</label>
                                <div class="btn-group btn-group-sm w-100 mb-2">
                                    <input type="radio" class="btn-check" name="metode" id="pay_qris" value="QRIS" checked onclick="showPay('box_qris')">
                                    <label class="btn btn-outline-danger" for="pay_qris">QRIS</label>

                                    <input type="radio" class="btn-check" name="metode" id="pay_va" value="VA" onclick="showPay('box_va')">
                                    <label class="btn btn-outline-danger" for="pay_va">Transfer</label>
                                </div>

                                <div id="box_qris" class="pay-box py-1">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=DailyCottonPayment" style="width: 120px; height: 120px;">
                                </div>
                                <div id="box_va" class="pay-box d-none py-2">
                                    <small class="text-muted">BCA Virtual Account:</small><br>
                                    <strong class="text-primary">8830 0812 3456 7890</strong>
                                </div>
                            </div>

                            <div class="row g-2">
                                <div class="col-6">
                                    <a href="index.php?url=user_home" class="btn btn-outline-secondary btn-sm w-100 fw-bold py-2 text-uppercase">
                                        Gagalkan Pesanan
                                    </a>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-danger btn-sm w-100 fw-bold py-2 shadow-sm text-uppercase">
                                        Bayar Sekarang
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showPay(id) {
    document.querySelectorAll('.pay-box').forEach(el => el.classList.add('d-none'));
    document.getElementById(id).classList.remove('d-none');
}

function hitungTotal() {
    const hargaSatuan = parseFloat(document.getElementById('harga_satuan').value);
    const jumlah = parseFloat(document.getElementById('input_jumlah').value);
    const displayTotal = document.getElementById('display_total');
    
    if(!isNaN(jumlah) && jumlah >= 1.5) {
        const total = hargaSatuan * jumlah;
        displayTotal.innerText = "Rp" + total.toLocaleString('id-ID');
    } else {
        displayTotal.innerText = "Rp0";
    }
}
</script>