<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-dark">DAFTAR AKUN</h2>
                    <p class="text-muted small">Lengkapi data di bawah ini untuk mendaftar</p>
                </div>
                
                <form action="index.php?url=proses_register" method="POST">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">NAMA LENGKAP</label>
                        <input type="text" name="nama" class="form-control form-control-lg bg-light" placeholder="Masukkan nama sesuai KTP" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">USERNAME</label>
                        <input type="text" name="username" class="form-control form-control-lg bg-light" placeholder="Buat username unik" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold">PASSWORD</label>
                        <input type="password" name="password" class="form-control form-control-lg bg-light" placeholder="Minimal 8 karakter" required>
                    </div>
                    
                    <button type="submit" class="btn btn-danger w-100 fw-bold py-3 rounded-3 mb-3">DAFTAR SEKARANG</button>
                    
                    <div class="text-center">
                        <span class="small text-muted">Sudah punya akun?</span>
                        <a href="index.php?url=login" class="small fw-bold text-danger text-decoration-none">Masuk Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>