<div class="pagetitle">
    <h1>Kategori</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= BASEURL ?>/">Home</a></li>
            <li class="breadcrumb-item active">Kategori</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <?= Flasher::flashBoots() ?>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex mb-2 justify-content-between align-items-center">
                        <h5 class="card-title">Data Kategori</h5>
                        <a href="<?= BASEURL ?>/kategori/create" class="btn btn-primary">Tambah Kategori</a>
                    </div>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['data_kategori'] as $item) : ?>
                                <tr>
                                    <td><?= $item['NamaKategori'] ?></td>
                                    <td>
                                        <a href="<?= BASEURL ?>/kategori/edit/<?= $item['KategoriID'] ?>" class="btn badge rounded-pill bg-success">Edit</a>
                                        <form action="<?= BASEURL ?>/kategori/destroy" method="post" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $item['KategoriID'] ?>">
                                            <button type="submit" class="btn badge rounded-pill bg-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>
        </div>
    </div>
</section>