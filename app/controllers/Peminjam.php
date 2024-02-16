<?php

class Peminjam extends Controller
{
    public function __construct()
    {
        // jika yang masuk bukan admin arahkan ke halaman 404
        if($_SESSION['Role'] !== 'admin') {
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
            'title' => 'Data Peminjam',
            'data_peminjam' => $this->model('UserModel')->get('peminjam')
        ];

        $this->view('template/header', $data);
        $this->view('peminjam/index', $data);
        $this->view('template/footer', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Peminjam'
        ];

        $this->view('template/header', $data);
        $this->view('peminjam/create', $data);
        $this->view('template/footer', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Tambah Data Peminjam',
            'data_peminjam' => $this->model('UserModel')->getById($id)
        ];

        $this->view('template/header', $data);
        $this->view('peminjam/edit', $data);
        $this->view('template/footer', $data);
    }

    /*
    |-------------------------------------------------------
    |       AKSI
    |--------------------------------------------------------
     */

     public function store()
    {
        // panggil user model untuk tambah data 
        $result = $this->model('UserModel')->create($_POST, 'peminjam');

        // cek apakah yang dikembalikan bukan string
        if (!is_string($result) && $result > 0) {
            Flasher::setFlash('Data berhasil ditambahkan!', 'success');
            $this->redirect('/peminjam');
        } else {
            Flasher::setFlash($result, 'danger');
            $this->redirect('/peminjam/create');
        }
    }

    public function update()
    {
        // panggil user model untuk update data 
        $result = $this->model('UserModel')->update($_POST);

        // cek apakah yang dikembalikan bukan string
        if (!is_string($result) && $result > 0) {
            Flasher::setFlash('Data berhasil diubah!', 'success');
            $this->redirect('/peminjam');
        } else {
            Flasher::setFlash($result, 'danger');
            $this->redirect('/peminjam/edit/' . $_POST['id']);
        }
    }
    
    public function destroy()
    {
        // panggil user model untuk delete data 
        $result = $this->model('UserModel')->delete($_POST['id']);

        // cek apakah yang dikembalikan lebih dari 0
        if ($result > 0) {
            Flasher::setFlash('Data berhasil dihapus!', 'success');
            $this->redirect('/peminjam');
        } else {
            Flasher::setFlash($result, 'danger');
            $this->redirect('/peminjam');
        }
    }
}