<div class="pagetitle">
    <h1>List Buku</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= BASEURL ?>/">Home</a></li>
            <li class="breadcrumb-item active">List Buku</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">

    <?php Flasher::flashBoots() ?>

    <div class="row">
        <?php foreach ($data['data_buku'] as $item) : ?>
            <div class="col-lg-4">
                <!-- Card with an image on top -->
                <div class="card">
                    <a href="<?= BASEURL ?>/lists/detail_buku/<?= $item['BukuID'] ?>">
                        <img src="<?= BASEURL ?>/img/sampul/<?= $item['Sampul'] ?>" class="card-img-top object-fit-cover" alt="Sampul" height="400">
                    </a>
                    <div class="card-body">
                        <a href="<?= BASEURL ?>/lists/detail_buku/<?= $item['BukuID'] ?>">
                            <h5 class="card-title"><?= $item['Judul'] ?></h5>
                        </a>
                        <div class="text-secondary">
                            <span class="card-text d-block">Tahun Terbit: <?= $item['TahunTerbit'] ?></span>
                            <span class="card-text d-block">Penulis : <?= $item['Penulis'] ?></span>
                            <span class="card-text d-block">Penerbit : <?= $item['Penerbit'] ?></span>
                        </div>
                        <div class="d-flex justify-content-end">
                            <?php
                            $action = BASEURL . '/lists/store_koleksi';
                            $icon = 'bi-bookmark';
                            $koleksi_id = null;

                            if(count($data['data_koleksi']) > 0) {
                                foreach ($data['data_koleksi'] as $koleksi) {
                                    if($item['BukuID'] === $koleksi['BukuID']) {
                                        $action = BASEURL . '/lists/destroy_koleksi';
                                        $icon = 'bi-bookmark-check-fill';
                                        $koleksi_id = $koleksi['KoleksiID'];
                                        break;
                                    }
                                }
                            }
                            ?>
                            <form action="<?= $action ?>" method="post">
                                <input type="hidden" name="buku_id" value="<?= $item['BukuID'] ?>">
                                <input type="hidden" name="koleksi_id" value="<?= $koleksi_id ?>">
                                <button type="submit" class="btn fs-4"><i class="bi <?= $icon ?>"></i></button>
                            </form>
                        </div>
                    </div>
                </div><!-- End Card with an image on top -->
            </div>
        <?php endforeach ?>
    </div>
</section>