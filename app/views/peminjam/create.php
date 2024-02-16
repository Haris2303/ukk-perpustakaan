<div class="pagetitle">
    <h1>Peminjam</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= BASEURL ?>/">Users</a></li>
            <li class="breadcrumb-item active">Peminjam</li>
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
                    <h5 class="card-title">Tambah Data Peminjam</h5>

                    <!-- Tambah Form -->
                    <form action="<?= BASEURL ?>/peminjam/store" method="POST" class="row g-3">
                        <div class="col-12">
                            <label for="namalengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" name="namalengkap" class="form-control" id="namalengkap">
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email">
                        </div>
                        <div class="col-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" name="alamat" class="form-control" id="alamat">
                        </div>
                        <div class="col-12">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="username">
                        </div>
                        <div class="col-12">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                        <div class="col-12">
                            <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
                            <input type="password" name="konfirmasi_password" class="form-control" id="konfirmasi_password">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>