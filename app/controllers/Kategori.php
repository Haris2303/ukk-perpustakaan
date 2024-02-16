<?php

class Kategori extends Controller
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
            'title' => 'Data Kategori',
            'data_kategori' => $this->model('KategoriModel')->get()
        ];

        $this->view('template/header', $data);
        $this->view('kategori/index', $data);
        $this->view('template/footer', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data kategori'
        ];

        $this->view('template/header', $data);
        $this->view('kategori/create', $data);
        $this->view('template/footer', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data kategori',
            'data_kategori' => $this->model('KategoriModel')->getBy($id)
        ];

        $this->view('template/header', $data);
        $this->view('kategori/edit', $data);
        $this->view('template/footer', $data);
    }

    /*
    |-------------------------------------------------------
    |       AKSI
    |--------------------------------------------------------
     */

    public function store()
    {
        // panggil kategori model untuk tambah data 
        $result = $this->model('KategoriModel')->create($_POST);

        // cek apakah yang dikembalikan bukan string
        if (!is_string($result) && $result > 0) {
            Flasher::setFlash('Data berhasil ditambahkan!', 'success');
            $this->redirect('/kategori');
        } else {
            Flasher::setFlash($result, 'danger');
            $this->redirect('/kategori/create');
        }
    }

    public function update()
    {
        // panggil kategori model untuk update data 
        $result = $this->model('KategoriModel')->update($_POST);

        // cek apakah yang dikembalikan bukan string
        if (!is_string($result) && $result > 0) {
            Flasher::setFlash('Data berhasil diubah!', 'success');
            $this->redirect('/kategori');
        } else {
            Flasher::setFlash($result, 'danger');
            $this->redirect('/kategori/edit/' . $_POST['id']);
        }
    }

    public function destroy()
    {
        // panggil kategori model untuk delete data 
        $result = $this->model('KategoriModel')->delete($_POST['id']);

        // cek apakah yang dikembalikan bukan string
        if (!is_string($result) && $result > 0) {
            Flasher::setFlash('Data berhasil dihapus!', 'success');
            $this->redirect('/kategori');
        } else {
            Flasher::setFlash($result, 'danger');
            $this->redirect('/kategori');
        }
    }
}