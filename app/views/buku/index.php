<div class="pagetitle">
    <h1>Buku</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Buku</li>
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
                    <h5 class="card-title">Data Buku</h5>
                    <a href="<?= BASEURL ?>/buku/create" class="btn btn-primary">Tambah Buku</a>
                </div>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Sampul</th>
                                <th>Judul Buku</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>Tahun Terbit</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['data_buku'] as $item): ?>
                            <tr>
                                <td><img src="<?= BASEURL ?>/img/sampul/<?= $item['Sampul'] ?>" alt="Sampul Buku" width="100"></td>
                                <td><?= $item['Judul'] ?></td>
                                <td><?php foreach ($data['kategoribuku'] as $kategori) {
                                    // Jika buku id nya sama dengan buku id pada kategoribuku relasi
                                    if($item['BukuID'] == $kategori['BukuID']) {
                                        // tampilkan kategorinya
                                        echo $kategori['NamaKategori'] . ', ';
                                    }
                                } ?></td>
                                <td><?= $item['Penulis'] ?></td>
                                <td><?= $item['Penerbit'] ?></td>
                                <td><?= $item['TahunTerbit'] ?></td>
                                <td>
                                    <a href="<?= BASEURL ?>/buku/detail/<?= $item['BukuID'] ?>" class="btn badge rounded-pill bg-primary">Detail</a>
                                    <a href="<?= BASEURL ?>/buku/edit/<?= $item['BukuID'] ?>" class="btn badge rounded-pill bg-success">Edit</a>
                                    <form action="<?= BASEURL ?>/buku/destroy" method="post" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $item['BukuID'] ?>">
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