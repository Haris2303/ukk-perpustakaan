<div class="pagetitle">
    <h1>Peminjam</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Users</a></li>
            <li class="breadcrumb-item active">Peminjam</li>
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
                    <h5 class="card-title">Data Peminjam</h5>
                    <a href="<?= BASEURL ?>/peminjam/create" class="btn btn-primary">Tambah Peminjam</a>
                </div>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['data_peminjam'] as $item): ?>
                            <tr>
                                <td><?= $item['NamaLengkap'] ?></td>
                                <td><?= $item['Username'] ?></td>
                                <td><?= $item['Email'] ?></td>
                                <td><?= $item['Alamat'] ?></td>
                                <td>
                                    <a href="<?= BASEURL ?>/peminjam/edit/<?= $item['UserID'] ?>" class="btn badge rounded-pill bg-success">Edit</a>
                                    <form action="<?= BASEURL ?>/peminjam/destroy" method="post" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $item['UserID'] ?>">
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