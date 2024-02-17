<div class="pagetitle">
    <h1>Koleksi Buku</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= BASEURL ?>/">Home</a></li>
            <li class="breadcrumb-item active">Koleksi</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <?php foreach ($data['data_koleksi'] as $item) : ?>
            <div class="col-lg-4">
                <!-- Card with an image on top -->
                <div class="card">
                    <img src="<?= BASEURL ?>/img/sampul/<?= $item['Sampul'] ?>" class="card-img-top object-fit-cover" alt="Sampul" height="400">
                    <div class="card-body">
                        <h5 class="card-title"><?= $item['Judul'] ?></h5>
                        <div class="text-secondary">
                            <span class="card-text d-block">Tahun Terbit: <?= $item['TahunTerbit'] ?></span>
                            <span class="card-text d-block">Penulis : <?= $item['Penulis'] ?></span>
                            <span class="card-text d-block">Penerbit : <?= $item['Penerbit'] ?></span>
                        </div>
                        <div class="d-flex justify-content-end">
                            <form action="<?= BASEURL ?>/lists/destroy_koleksi" method="post">
                                <input type="hidden" name="koleksi_id" value="<?= $item['KoleksiID'] ?>">
                                <button type="submit" class="btn fs-4"><i class="bi bi-bookmark-check-fill"></i></button>
                            </form>
                        </div>
                    </div>
                </div><!-- End Card with an image on top -->
            </div>
        <?php endforeach ?>
    </div>
</section>