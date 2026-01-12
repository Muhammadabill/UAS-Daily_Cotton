<div class="container my-5">
    <div class="card mx-auto shadow-sm" style="max-width: 450px; border: 1px dashed #ccc;">
        <div class="card-body text-center">
            <h4 class="fw-bold text-danger">DAILY COTTON</h4>
            <p class="small text-muted">Premium Fabric Inventory System<br>Tanggal: <?= date('d/m/Y H:i') ?></p>
            <hr>
            <div class="text-start small">
                <div class="d-flex justify-content-between mb-1"><span>Produk:</span> <strong><?= $nama_bahan ?></strong></div>
                <div class="d-flex justify-content-between mb-1"><span>Warna:</span> <strong><?= $warna ?></strong></div>
                <div class="d-flex justify-content-between mb-1"><span>Jumlah:</span> <strong><?= $qty ?> Kg</strong></div>
                <div class="d-flex justify-content-between mb-1"><span>Metode:</span> <strong><?= $metode ?></strong></div>
            </div>
            <hr>
            <div class="d-flex justify-content-between fw-bold text-danger fs-5">
                <span>TOTAL BAYAR</span>
                <span>Rp<?= number_format($total, 0, ',', '.') ?></span>
            </div>
            <div class="mt-4 p-2 bg-light rounded small text-success">
                <i class="bi bi-check-circle-fill"></i> PEMBAYARAN BERHASIL
            </div>
            <button onclick="window.print()" class="btn btn-outline-dark btn-sm mt-4 w-100">Cetak Struk PDF</button>
        </div>
    </div>
</div>