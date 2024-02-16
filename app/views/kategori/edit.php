<div class="pagetitle">
    <h1>Kategori</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= BASEURL ?>/">Kategori</a></li>
            <li class="breadcrumb-item active">Kategori</li>
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
                    <h5 class="card-title">Edit Data Kategori</h5>

                    <!-- Edit Form -->
                    <form action="<?= BASEURL ?>/kategori/update" method="POST" class="row g-3">
                        <input type="hidden" name="id" value="<?= $data['data_kategori']['KategoriID'] ?>">
                        <div class="col-12">
                            <label for="namakategori" class="form-label">Nama Kategori</label>
                            <input type="text" name="namakategori" class="form-control" id="namakategori" value="<?= $data['data_kategori']['NamaKategori'] ?>">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>