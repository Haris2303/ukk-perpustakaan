<?php

class Peminjaman extends Controller
{
    public function __construct()
    {
        // jika yang akses adalah peminjam arahkan ke halaman 404
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
            'title' => 'Data Peminjaman',
            'data_peminjaman' => $this->model('PeminjamanModel')->get()
        ];

        $this->view('template/header', $data);
        $this->view('peminjaman/index', $data);
        $this->view('template/footer', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Peminjaman',
            'data_buku' => $this->model('BukuModel')->get(),
            'data_peminjam' => $this->model('UserModel')->get('peminjam')
        ];

        $this->view('template/header', $data);
        $this->view('peminjaman/create', $data);
        $this->view('template/footer', $data);
    }

    public function report()
    {
        $data = [
            'pdf' => new Laporan(),
            'data_content' => $this->model('PeminjamanModel')->get()
        ];

        $this->view('peminjaman/laporan', $data);
    }

    /*
    |-------------------------------------------------------
    |       AKSI
    |--------------------------------------------------------
     */
    public function store()
    {
        // panggil peminjaman model untuk tambah data 
        $result = $this->model('PeminjamanModel')->create($_POST);

        // cek apakah yang dikembalikan bukan string
        if (!is_string($result) && $result > 0) {
            Flasher::setFlash('Data berhasil ditambahkan!', 'success');
            $this->redirect('/peminjaman');
        } else {
            Flasher::setFlash($result, 'danger');
            $this->redirect('/peminjaman/create');
        }
    }

    public function update()
    {
        // panggil peminjaman model untuk edit data 
        $result = $this->model('PeminjamanModel')->update($_POST['id']);

        // cek yang dikembalikan lebih dari 0
        if ($result > 0) {
            Flasher::setFlash('Data Status berhasil diubah!', 'success');
            $this->redirect('/peminjaman');
        } else {
            Flasher::setFlash('Data Status gagal diubah!', 'danger');
            $this->redirect('/peminjaman');
        }
    }

    public function destroy()
    {
        // panggil peminjaman model untuk hapus data 
        $result = $this->model('PeminjamanModel')->delete($_POST['id']);

        // cek yang dikembalikan lebih dari 0
        if ($result > 0) {
            Flasher::setFlash('Data berhasil dihapus!', 'success');
            $this->redirect('/peminjaman');
        } else {
            Flasher::setFlash('Data gagal dihapus!', 'danger');
            $this->redirect('/peminjaman');
        }
    }

}