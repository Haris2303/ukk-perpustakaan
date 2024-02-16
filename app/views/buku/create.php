<div class="pagetitle">
    <h1>Buku</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= BASEURL ?>/">Buku</a></li>
            <li class="breadcrumb-item active">Tambah</li>
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
                    <h5 class="card-title">Tambah Data Buku</h5>

                    <!-- Tambah Form -->
                    <form action="<?= BASEURL ?>/buku/store" method="POST" class="row g-3" enctype="multipart/form-data">
                        <div class="col-12">
                            <label for="sampul" class="form-label">Sampul Buku</label>
                            <input type="file" name="gambar" class="form-control" id="sampul">
                        </div>
                        <div class="col-12">
                            <label for="judul" class="form-label">Judul Buku</label>
                            <input type="text" name="judul" class="form-control" id="judul">
                        </div>
                        <div class="col-12">
                            <legend class="col-form-label col-sm-2 pt-0">Kategori</legend>
                            <div class="col-sm-10">
                                <?php foreach($data['data_kategori'] as $item): ?>
                                <div class="form-check">
                                    <input name="kategori[]" class="form-check-input" type="checkbox" id="check-<?= $item['KategoriID'] ?>" value="<?= $item['KategoriID'] ?>">
                                    <label class="form-check-label" for="check-<?= $item['KategoriID'] ?>">
                                        <?= $item['NamaKategori'] ?>
                                    </label>
                                </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="penulis" class="form-label">Penulis</label>
                            <input type="text" name="penulis" class="form-control" id="penulis">
                        </div>
                        <div class="col-12">
                            <label for="penerbit" class="form-label">Penerbit</label>
                            <input type="text" name="penerbit" class="form-control" id="penerbit">
                        </div>
                        <div class="col-12">
                            <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                            <input type="year" name="tahun_terbit" class="form-control" id="tahun_terbit">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>