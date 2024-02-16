<?php

class Admin extends Controller
{
    public function index()
    {
        $data = [
            'judul' => 'Tambah Admin'
        ];

        $this->view('template/normalheader', $data);
        $this->view('admin/index', $data);
        $this->view('template/footer', $data);
    }
    
    public function store()
    {
        $result = $this->model('Admin_model')->create($_POST);
        if(is_int($result)) {
            echo "Berhasil";
            exit;
        } else {
            echo "Gagal";
            exit;
        }
    }
}