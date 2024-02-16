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

                <?php $tulisUlasan = true ?>

                <div class="col-lg-8 m-3">
                    <details>
                        <summary>Ulasan Peminjam</summary>
                        <?php foreach($data['data_ulasan'] as $ulasan): ?>
                        <?php 
                        // jika ulasan user id sama dengan user id saat ini maka set tulisUlasan jadi false
                        if($ulasan['UserID'] === $_SESSION['user_id']) {
                            $tulisUlasan = false;
                        }
                        ?>
                        <div class="my-3 border p-2 px-3">
                            <h5><?= $ulasan['Username'] ?></h5>
                            <span>Rating: <?= $ulasan['Rating'] ?></span>
                            <p><?= $ulasan['Ulasan'] ?></p>
                            <!-- Jika tulisUlasan false maka peminjam dapat menghapus ulasannya -->
                            <?php if(!$tulisUlasan): ?>
                                <form action="<?= BASEURL ?>/lists/destroy_ulasan" method="post" class="d-flex justify-content-end">
                                    <input type="hidden" name="ulasan_id" value="<?= $ulasan['UlasanID'] ?>">
                                    <button type="submit" class="badge btn btn-danger">Hapus Ulasan</button>
                                </form>
                            <?php endif ?>
                        </div>
                        <?php endforeach ?>
                    </details>
                </div>
                
                <?php if($tulisUlasan): ?>
                    <div class="col-lg-6">
                        <form action="<?= BASEURL ?>/lists/store_ulasan" method="post" class="mx-3">
                            <input type="hidden" name="buku_id" value="<?= $data['data_buku']['BukuID'] ?>">
                            <div class="mb-3">
                                <label for="rating" class="form-label">Rating</label>
                                <select name="rating" id="rating" class="form-control">
                                    <option selected disabled>-- Pilih Rating --</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="ulasan" class="form-label">Ulasan Anda</label>
                                <textarea name="ulasan" id="ulasan" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </form>
                    </div>
                <?php endif ?>

                <div class="d-flex justify-content-end m-3">
                    <a href="<?= BASEURL ?>/lists/buku" class="btn btn-secondary">Kembali</a>
                </div>
            </div><!-- End Card with an image on top -->
        </div>
    </div>
</section>