<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white py-3 border-bottom">
        <h5 class="fw-bold m-0"><i class="bi bi-people-fill text-primary me-2"></i> Detail Pesanan Pelanggan</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-uppercase small">
                <tr>
                    <th class="ps-4">ID / Waktu</th>
                    <th>Nama Pembeli</th>
                    <th>Produk</th>
                    <th>Ketebalan</th>
                    <th>Total Bayar</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql = "SELECT orders.*, users.username as nama_pembeli, materials.nama_bahan 
                        FROM orders 
                        LEFT JOIN users ON orders.user_id = users.id 
                        LEFT JOIN materials ON orders.material_id = materials.id 
                        ORDER BY orders.id DESC";
                $orders = $app->conn->query($sql);

                if($orders && $orders->num_rows > 0):
                    while($o = $orders->fetch_assoc()): ?>
                    <tr>
                        <td class="ps-4">
                            <div class="fw-bold small">#ORD-<?= $o['id'] ?></div>
                            <small class="text-muted" style="font-size: 11px;">
                                <?= date('d/m/y H:i', strtotime($o['tgl_pesan'])) ?>
                            </small>
                        </td>
                        <td class="fw-bold text-primary small"><?= $o['nama_pembeli'] ?></td>
                        <td>
                            <div class="fw-bold small"><?= $o['nama_bahan'] ?></div>
                            <small class="text-muted"><?= $o['jumlah_beli'] ?> Kg</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">
                                <?= str_replace("GSM", "", $o['ketebalan_beli']) ?> GSM
                            </span>
                        </td>
                        <td class="fw-bold text-danger">Rp<?= number_format($o['total_harga'], 0, ',', '.') ?></td>
                        <td class="text-center">
                            <span class="badge bg-success rounded-pill px-3">Selesai</span>
                        </td>
                    </tr>
                <?php endwhile; else: ?>
                    <tr><td colspan="6" class="text-center py-5 text-muted">Data pesanan kosong.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>