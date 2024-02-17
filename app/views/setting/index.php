<div class="pagetitle">
    <h1>Pengaturan Akun</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= BASEURL ?>/">Home</a></li>
            <li class="breadcrumb-item active">Pengaturan</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-8">
            
            <!-- Tampilkan alert jika ada -->
            <?= Flasher::flashBoots() ?>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ubah Password</h5>

                    <!-- Tambah Form -->
                    <form action="<?= BASEURL ?>/setting/update_password" method="POST" class="row g-3">
                        <div class="col-12">
                            <label for="password_lama" class="form-label">Password Lama</label>
                            <input type="password" name="password_lama" class="form-control" id="tanggal_peminjaman">
                        </div>
                        <div class="col-12">
                            <label for="password_baru" class="form-label">Password Baru</label>
                            <input type="password" name="password_baru" class="form-control" id="tanggal_peminjaman">
                        </div>
                        <div class="col-12">
                            <label for="password_konfirmasi" class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_konfirmasi" class="form-control" id="tanggal_peminjaman">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>