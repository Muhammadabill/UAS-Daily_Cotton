<?php
// Proteksi Admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php?url=user_home");
    exit;
}

// Ambil Data Statistik
$total_katalog = $app->conn->query("SELECT COUNT(*) as total FROM materials")->fetch_assoc()['total'];
$stok_kritis = $app->conn->query("SELECT COUNT(*) as total FROM materials WHERE stok < 10")->fetch_assoc()['total'];
?>

<div class="container-fluid p-4">
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm rounded-4 border-0 bg-primary text-white h-100">
                <div class="card-body text-center py-4">
                    <small class="text-uppercase fw-bold opacity-75">Total Katalog</small>
                    <h2 class="fw-bold m-0 mt-2"><?= $total_katalog ?> Jenis</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm rounded-4 border-0 bg-danger text-white h-100">
                <div class="card-body text-center py-4">
                    <small class="text-uppercase fw-bold opacity-75">Stok Kritis</small>
                    <h2 class="fw-bold m-0 mt-2"><?= $stok_kritis ?> Item</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm rounded-4 border-0 bg-success text-white h-100 d-flex align-items-center justify-content-center" 
                 style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <div class="card-body text-center">
                    <i class="bi bi-plus-circle fs-3 mb-2"></i>
                    <h5 class="fw-bold m-0">TAMBAH MATERIAL BARU</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h5 class="fw-bold m-0"><i class="bi bi-list-ul me-2"></i> Inventory Control</h5>
            <div class="input-group input-group-sm" style="width: 250px;">
                <input type="text" class="form-control" placeholder="Cari kain...">
                <button class="btn btn-dark"><i class="bi bi-search"></i></button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-uppercase small">
                    <tr>
                        <th class="ps-4">Material & Warna</th>
                        <th>Stok Saat Ini</th>
                        <th>Harga Jual</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $res = $app->conn->query("SELECT * FROM materials ORDER BY id DESC");
                    while($m = $res->fetch_assoc()): 
                        $ketebalan = str_replace("GSM", "", $m['ketebalan']);
                    ?>
                    <tr>
                        <td class="ps-4">
                            <div class="fw-bold"><?= $m['nama_bahan'] ?></div>
                            <small class="text-muted text-uppercase"><?= $m['warna'] ?> | <?= trim($ketebalan) ?> GSM</small>
                        </td>
                        <td>
                            <span class="badge bg-success px-3 py-2"><?= $m['stok'] ?> Kg</span>
                        </td>
                        <td class="fw-bold">Rp<?= number_format($m['harga'], 0, ',', '.') ?></td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-outline-primary border-0" data-bs-toggle="modal" data-bs-target="#editModal<?= $m['id'] ?>">
                                    <i class="bi bi-pencil-square fs-5"></i>
                                </button>
                                <a href="index.php?url=hapus_material&id=<?= $m['id'] ?>" class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Hapus material ini?')">
                                    <i class="bi bi-trash fs-5"></i>
                                </a>
                            </div>
                        </td>
                    </tr>

                    <div class="modal fade" id="editModal<?= $m['id'] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content rounded-4">
                                <form action="index.php?url=proses_update_material" method="POST">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title fw-bold">Update Material</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <input type="hidden" name="id" value="<?= $m['id'] ?>">
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Nama Bahan</label>
                                            <input type="text" name="nama_bahan" class="form-control" value="<?= $m['nama_bahan'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Warna</label>
                                            <input type="text" name="warna" class="form-control" value="<?= $m['warna'] ?>" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 mb-3">
                                                <label class="form-label small fw-bold">Stok (Kg)</label>
                                                <input type="number" name="stok" class="form-control" value="<?= $m['stok'] ?>" required>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <label class="form-label small fw-bold">Harga (Rp)</label>
                                                <input type="number" name="harga" class="form-control" value="<?= $m['harga'] ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-4">
            <form action="index.php?url=proses_tambah_material" method="POST">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Tambah Material Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama Bahan</label>
                        <input type="text" name="nama_bahan" class="form-control" placeholder="Contoh: Cotton Combed 30s" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Warna</label>
                        <input type="text" name="warna" class="form-control" placeholder="Contoh: Jet Black" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Ketebalan (Angka saja)</label>
                        <div class="input-group">
                            <input type="number" name="ketebalan" class="form-control" placeholder="Contoh: 150" required>
                            <span class="input-group-text">GSM</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label small fw-bold">Stok Awal (Kg)</label>
                            <input type="number" name="stok" class="form-control" value="0" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label small fw-bold">Harga per Kg</label>
                            <input type="number" name="harga" class="form-control" placeholder="Rp" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success px-4">Simpan Material</button>
                </div>
            </form>
        </div>
    </div>
</div>