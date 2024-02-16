<div class="pagetitle">
    <h1>Buku</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= BASEURL ?>/">Buku</a></li>
            <li class="breadcrumb-item active">Edit</li>
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
                    <h5 class="card-title">Edit Data Buku</h5>

                    <!-- Edit Form -->
                    <form action="<?= BASEURL ?>/buku/update" method="POST" class="row g-3" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $data['data_buku']['BukuID'] ?>">
                        <input type="hidden" name="gambarLama" value="<?= $data['data_buku']['Sampul'] ?>">
                        <input type="hidden" name="judulLama" value="<?= $data['data_buku']['Judul'] ?>">
                        <div class="col-12">
                            <p class="form-label">Sampul Saat Ini</p>
                            <img src="<?= BASEURL ?>/img/sampul/<?= $data['data_buku']['Sampul'] ?>" alt="Sampul" width="200">
                        </div>
                        <div class="col-12">
                            <label for="sampul" class="form-label">Sampul Buku</label>
                            <input type="file" name="gambar" class="form-control" id="sampul">
                        </div>
                        <div class="col-12">
                            <label for="judul" class="form-label">Judul Buku</label>
                            <input type="text" name="judul" class="form-control" id="judul" value="<?= $data['data_buku']['Judul'] ?>">
                        </div>
                        <div class="col-12">
                            <legend class="col-form-label col-sm-2 pt-0">Kategori</legend>
                            <div class="col-sm-10">
                                <?php foreach($data['data_kategori'] as $item): ?>
                                <div class="form-check">
                                    <!-- cek jika kategoribuku id sama dengan kategori id maka centang -->
                                    <input name="kategori[]" class="form-check-input" type="checkbox"
                                    <?php foreach ($data['data_kategoribuku'] as $value) {
                                        if($value['KategoriID'] === $item['KategoriID']) {
                                            echo 'checked';
                                        }
                                    } ?>
                                     id="check-<?= $item['KategoriID'] ?>" value="<?= $item['KategoriID'] ?>">
                                    <label class="form-check-label" for="check-<?= $item['KategoriID'] ?>">
                                        <?= $item['NamaKategori'] ?>
                                    </label>
                                </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="penulis" class="form-label">Penulis</label>
                            <input type="text" name="penulis" class="form-control" id="penulis" value="<?= $data['data_buku']['Penulis'] ?>">
                        </div>
                        <div class="col-12">
                            <label for="penerbit" class="form-label">Penerbit</label>
                            <input type="text" name="penerbit" class="form-control" id="penerbit" value="<?= $data['data_buku']['Penerbit'] ?>">
                        </div>
                        <div class="col-12">
                            <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                            <input type="year" name="tahun_terbit" class="form-control" id="tahun_terbit" value="<?= $data['data_buku']['TahunTerbit'] ?>">
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