<?php

class Setting extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pengaturan Akun'
        ];

        $this->view('template/header', $data);
        $this->view('setting/index', $data);
        $this->view('template/footer');
    }

    public function update_password()
    {
        $result = $this->model('UserModel')->updatePassword($_POST);

        // cek apakah yang dikembalikan bukan string
        if (!is_string($result) && $result > 0) {
            Flasher::setFlash('Password berhasil diubah!', 'success');
            $this->redirect('/setting');
        } else {
            Flasher::setFlash($result, 'danger');
            $this->redirect('/setting');
        }
    }
}