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
        <div class="col-lg-12">

            <?= Flasher::flashBoots() ?>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex mb-2 justify-content-between align-items-center">
                        <h5 class="card-title">Data Peminjaman</h5>
                        <div>
                            <a href="<?= BASEURL ?>/peminjaman/report" class="btn btn-secondary text-light" target="_blank"><i class="bi bi-filetype-pdf"></i> Generate Laporan</a>
                            <a href="<?= BASEURL ?>/peminjaman/create" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Peminjaman</a>
                        </div>
                    </div>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Judul Buku</th>
                                <th>Nama Peminjam</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['data_peminjaman'] as $item) : ?>
                                <tr>
                                    <td><?= $item['BukuID'] ?></td>
                                    <td><?= $item['UserID'] ?></td>
                                    <td><?= $item['TanggalPeminjaman'] ?></td>
                                    <td><?= $item['TanggalPengembalian'] ?></td>
                                    <td>
                                        <?php if ($item['StatusPeminjaman'] === 'dipinjam') : ?>
                                            <form action="<?= BASEURL ?>/peminjaman/update" method="post">
                                                <input type="hidden" name="id" value="<?= $item['PeminjamanID'] ?>">
                                                <button type="submit"
                                                    class="btn badge rounded-pill bg-warning" 
                                                    onclick="return confirm('Apakah buku telah dikembalikan?')">Diinjam</button>
                                            </form>
                                        <?php elseif ($item['StatusPeminjaman'] === 'dikembalikan') : ?>
                                            <span class="badge rounded-pill bg-info">Dikembalikan</span>
                                        <?php endif ?>
                                    </td>
                                    </td>
                                    <td>
                                        <form action="<?= BASEURL ?>/peminjaman/destroy" method="post" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $item['PeminjamanID'] ?>">
                                            <button type="submit" class="btn badge rounded-pill bg-danger"><i class="bi bi-trash"></i> Hapus</button>
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