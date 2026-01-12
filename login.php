<div class="d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="card border-0 shadow-lg rounded-4 p-4" style="width: 100%; max-width: 400px;">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-danger mb-0">DAILY COTTON</h2>
            <p class="text-muted small text-uppercase letter-spacing-1">Fabric Inventory System</p>
        </div>

        <form action="index.php?url=proses_login" method="POST">
            <div class="mb-3">
                <label class="form-label small fw-bold text-muted">USERNAME</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                    <input type="text" name="username" class="form-control bg-light border-start-0" placeholder="admin / user1" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-muted">PASSWORD</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                    <input type="password" name="password" class="form-control bg-light border-start-0" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn btn-danger w-100 fw-bold py-2 shadow-sm rounded-3">
                MASUK SEKARANG
            </button>
        </form>

        <div class="text-center mt-4">
            <p class="small text-muted mb-0">Belum punya akun?</p>
            <a href="index.php?url=register" class="text-danger fw-bold text-decoration-none small text-uppercase">Daftar Akun Baru</a>
        </div>
        
        <div class="text-center mt-5">
            <small class="text-muted" style="font-size: 0.7rem;">© 2026 DAILY COTTON PREMIUM TEXTILE</small>
        </div>
    </div>
</div>