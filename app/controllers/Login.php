<?php

class Login extends Controller
{
    public function __construct()
    {
        if (isset($_SESSION['is_login'])) {
            $this->redirect('/');
        }
    }

    public function index(): void
    {
        $data = [
            'title' => 'Login'
        ];

        $this->view('login/index', $data);
    }

    public function do_login()
    {
        $result = $this->model('UserModel')->login($_POST);
        if ($result) {
            $this->redirect('/');
        } else {
            Flasher::setFlash('Username atau Password Salah!', 'danger');
            $this->redirect('/login');
        }
    }
}
