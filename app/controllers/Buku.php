<?php

class Buku extends Controller
{
    public function __construct()
    {
        if($_SESSION['Role'] === 'peminjam') {
            $this->view('error/404');
            exit;
        }
    }

    /*
    |-------------------------------------------------------
    |       VIEW
    |--------------------------------------------------------
     */
    public function index()
    {
        $data = [
            'title' => 'Data Buku',
            'data_buku' => $this->model('BukuModel')->get(),
            'kategoribuku' => $this->model('KategoriRelasiModel')->get()
        ];

        $this->view('template/header', $data);
        $this->view('buku/index', $data);
        $this->view('template/footer', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Buku',
            'data_kategori' => $this->model('KategoriModel')->get()
        ];

        $this->view('template/header', $data);
        $this->view('buku/create', $data);
        $this->view('template/footer', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Ubah Data Buku',
            'data_kategori' => $this->model('KategoriModel')->get(),
            'data_buku' => $this->model('BukuModel')->getBy($id),
            'data_kategoribuku' => $this->model('KategoriRelasiModel')->getByBukuId($id)
        ];

        $this->view('template/header', $data);
        $this->view('buku/edit', $data);
        $this->view('template/footer', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Buku',
            'data_buku' => $this->model('BukuModel')->getBy($id),
            'data_kategoribuku' => $this->model('KategoriRelasiModel')->getByBukuId($id)
        ];

        $this->view('template/header', $data);
        $this->view('buku/detail', $data);
        $this->view('template/footer', $data);
    }

    /*
    |-------------------------------------------------------
    |       AKSI
    |--------------------------------------------------------
     */
    public function store()
    {
        // panggil buku model untuk tambah data 
        $result = $this->model('BukuModel')->create($_POST, $_FILES);

        // cek apakah yang dikembalikan bukan string
        if (!is_string($result) && $result > 0) {
            Flasher::setFlash('Data berhasil ditambahkan!', 'success');
            $this->redirect('/buku');
        } else {
            Flasher::setFlash($result, 'danger');
            $this->redirect('/buku/create');
        }
    }

    public function update()
    {
        // panggil buku model untuk update data 
        $result = $this->model('BukuModel')->update($_POST, $_FILES);

        // cek apakah yang dikembalikan bukan string
        if (!is_string($result) && $result > 0) {
            Flasher::setFlash('Data berhasil diubah!', 'success');
            $this->redirect('/buku');
        } else {
            Flasher::setFlash($result, 'danger');
            $this->redirect('/buku/edit/' . $_POST['id']);
        }
    }

    public function destroy()
    {
        // panggil buku model untuk delete data 
        $result = $this->model('BukuModel')->delete($_POST['id']);

        // cek apakah yang dikembalikan bukan string
        if ($result > 0) {
            Flasher::setFlash('Data berhasil dihapus!', 'success');
            $this->redirect('/buku');
        } else {
            Flasher::setFlash('Data gagal dihapus', 'danger');
            $this->redirect('/buku');
        }
    }
}