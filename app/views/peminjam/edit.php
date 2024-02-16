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
                    <h5 class="card-title">Edit Data Peminjam</h5>

                    <!-- Edit Form -->
                    <form action="<?= BASEURL ?>/peminjam/update" method="POST" class="row g-3">
                        <input type="hidden" name="id" value="<?= $data['data_peminjam']['UserID'] ?>">
                        <div class="col-12">
                            <label for="namalengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" name="namalengkap" class="form-control" id="namalengkap" value="<?= $data['data_peminjam']['NamaLengkap'] ?>">
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="<?= $data['data_peminjam']['Email'] ?>">
                        </div>
                        <div class="col-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" name="alamat" class="form-control" id="alamat" value="<?= $data['data_peminjam']['Alamat'] ?>">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>