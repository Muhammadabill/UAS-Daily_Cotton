<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white py-3">
        <h5 class="fw-bold m-0 text-danger"><i class="bi bi-bag-check-fill"></i> Riwayat Belanja Saya</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr class="small text-uppercase">
                    <th class="ps-4">Produk</th>
                    <th>Ketebalan</th>
                    <th>Qty (Kg)</th>
                    <th>Total Bayar</th>
                    <th>Tanggal</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $uid = $_SESSION['user_id'];
                $query = "SELECT o.*, m.nama_bahan, m.warna 
                          FROM orders o 
                          INNER JOIN materials m ON o.material_id = m.id 
                          WHERE o.user_id = '$uid' 
                          ORDER BY o.id DESC";
                          
                $res = $app->conn->query($query);
                
                if ($res && $res->num_rows > 0):
                    while($o = $res->fetch_assoc()): 
                        // Perbaikan penanggalan agar tidak muncul 1970
                        $tgl = (!empty($o['tgl_pesan'])) ? date('d/m/Y H:i', strtotime($o['tgl_pesan'])) : date('d/m/Y H:i');
                    ?>
                    <tr>
                        <td class="ps-4">
                            <div class="fw-bold text-uppercase"><?= $o['nama_bahan'] ?></div>
                            <small class="text-muted"><?= $o['warna'] ?></small>
                        </td>
                        <td><span class="badge bg-light text-dark border"><?= $o['ketebalan_beli'] ?></span></td>
                        <td><?= number_format($o['jumlah_beli'], 2) ?> Kg</td>
                        <td class="fw-bold text-danger">Rp<?= number_format($o['total_harga'], 0,',','.') ?></td>
                        <td class="small text-muted"><?= $tgl ?></td>
                        <td class="text-center"><span class="badge bg-success">Selesai</span></td>
                    </tr>
                <?php endwhile; else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Anda belum memiliki riwayat pesanan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>