<?php

class Petugas extends Controller
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
            'title' => 'Data Petugas',
            'data_petugas' => $this->model('UserModel')->get('petugas')
        ];

        $this->view('template/header', $data);
        $this->view('petugas/index', $data);
        $this->view('template/footer', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Petugas'
        ];

        $this->view('template/header', $data);
        $this->view('petugas/create', $data);
        $this->view('template/footer', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Petugas',
            'data_petugas' => $this->model('UserModel')->getById($id)
        ];

        $this->view('template/header', $data);
        $this->view('petugas/edit', $data);
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
        $result = $this->model('UserModel')->create($_POST, 'petugas');

        // cek apakah yang dikembalikan bukan string
        if (!is_string($result) && $result > 0) {
            Flasher::setFlash('Data berhasil ditambahkan!', 'success');
            $this->redirect('/petugas');
        } else {
            Flasher::setFlash($result, 'danger');
            $this->redirect('/petugas/create');
        }
    }

    public function update()
    {
        // panggil user model untuk update data 
        $result = $this->model('UserModel')->update($_POST);

        // cek apakah yang dikembalikan bukan string
        if (!is_string($result) && $result > 0) {
            Flasher::setFlash('Data berhasil diubah!', 'success');
            $this->redirect('/petugas');
        } else {
            Flasher::setFlash($result, 'danger');
            $this->redirect('/petugas/edit/' . $_POST['id']);
        }
    }
    
    public function destroy()
    {
        // panggil user model untuk delete data 
        $result = $this->model('UserModel')->delete($_POST['id']);

        // cek apakah yang dikembalikan bukan string
        if (!is_string($result) && $result > 0) {
            Flasher::setFlash('Data berhasil dihapus!', 'success');
            $this->redirect('/petugas');
        } else {
            Flasher::setFlash($result, 'danger');
            $this->redirect('/petugas');
        }
    }
}