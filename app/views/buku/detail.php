<div class="pagetitle">
    <h1>Detail Buku</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= BASEURL ?>/">Home</a></li>
            <li class="breadcrumb-item active">List Buku</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-10">
            <!-- Card with an image on top -->
            <div class="card">
                <div class="d-flex">
                    <div class="m-3">
                        <img src="<?= BASEURL ?>/img/sampul/<?= $data['data_buku']['Sampul'] ?>" class="card-img-left" alt="Sampul" height="400">
                    </div>
                    <div class="card-body mt-3 fs-5">
                        <p class="card-text">Judul : <?= $data['data_buku']['Judul'] ?></p>
                        <p class="card-text d-block">Tahun Terbit: <?= $data['data_buku']['TahunTerbit'] ?></p>
                        <p class="card-text d-block">Penulis : <?= $data['data_buku']['Penulis'] ?></p>
                        <p class="card-text d-block">Penerbit : <?= $data['data_buku']['Penerbit'] ?></p>
                    </div>
                </div>
                <div class="d-flex justify-content-end m-3">
                    <a href="<?= BASEURL ?>/buku" class="btn btn-secondary">Kembali</a>
                </div>
            </div><!-- End Card with an image on top -->
        </div>
    </div>
</section>