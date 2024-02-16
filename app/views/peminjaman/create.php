<div class="pagetitle">
    <h1>Peminjaman</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= BASEURL ?>/">Home</a></li>
            <li class="breadcrumb-item active">Peminjaman</li>
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
                    <h5 class="card-title">Tambah Data Peminjaman</h5>

                    <!-- Tambah Form -->
                    <form action="<?= BASEURL ?>/peminjaman/store" method="POST" class="row g-3">
                        <div class="col-12">
                            <label for="judul" class="form-label">Judul Buku</label>
                            <select name="bukuId" id="judul" class="form-control">
                                <option selected>-- Pilih Buku --</option>
                                <?php foreach($data['data_buku'] as $buku): ?>
                                    <option value="<?= $buku['BukuID'] ?>"><?= $buku['Judul'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="peminjam" class="form-label">Username Peminjam</label>
                            <select name="userId" id="peminjam" class="form-control">
                                <option selected>-- Pilih Peminjam --</option>
                                <?php foreach($data['data_peminjam'] as $peminjam): ?>
                                    <option value="<?= $peminjam['UserID'] ?>"><?= $peminjam['Username'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="tanggal_peminjaman" class="form-label">Tanggal Peminjaman</label>
                            <input type="date" name="tanggal_peminjaman" class="form-control" id="tanggal_peminjaman">
                        </div>
                        <div class="col-12">
                            <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
                            <input type="date" name="tanggal_pengembalian" class="form-control" id="tanggal_pengembalian">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>