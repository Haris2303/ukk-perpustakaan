<?php

class Register extends Controller
{
    public function __construct()
    {
        if (isset($_SESSION['is_login'])) {
            $this->redirect('/');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Register'
        ];

        $this->view('register/index', $data);
    }

    public function store()
    {
        $result = $this->model('UserModel')->create($_POST, 'peminjam');
        if (!is_string($result) && $result > 0) {
            Flasher::setFlash('User berhasil mendaftar!', 'success');
            $this->redirect('/login');
        } else {
            Flasher::setFlash($result, 'danger');
            $this->redirect('/register');
        }
    }
}
