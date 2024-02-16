<?php 

class Lists extends Controller
{
    public function __construct()
    {
        if($_SESSION['Role'] !== 'peminjam') {
            $this->view('error/404');
            exit;
        }
    }

    public function index()
    {
        $this->redirect('/lists/buku');
    }

    public function buku()
    {
        $data = [
            'title' => 'List Buku',
            'data_buku' => $this->model('BukuModel')->get(),
            'data_koleksi' => $this->model('KoleksiModel')->getBy($_SESSION['user_id'])
        ];

        $this->view('template/header', $data);
        $this->view('list/buku', $data);
        $this->view('template/footer', $data);
    }

    public function detail_buku($buku_id)
    {
        $data = [
            'title' => 'Detail Buku',
            'data_buku' => $this->model('BukuModel')->getBy($buku_id),
            'data_ulasan' => $this->model('UlasanBukuModel')->getByBukuId($buku_id)
        ];

        $this->view('template/header', $data);
        $this->view('list/detail', $data);
        $this->view('template/footer', $data);
    }

    public function peminjaman($id)
    {
        $data = [
            'title' => 'Peminjaman Saya',
            'data_peminjaman' => $this->model('PeminjamanModel')->getBy($id)
        ];

        $this->view('template/header', $data);
        $this->view('list/peminjaman', $data);
        $this->view('template/footer', $data);
    }

    public function koleksi()
    {
        $data = [
            'title' => 'Koleksi',
            'data_koleksi' => $this->model('KoleksiModel')->getViewBy($_SESSION['user_id'])
        ];

        $this->view('template/header', $data);
        $this->view('list/koleksi', $data);
        $this->view('template/footer', $data);
    }

    public function store_koleksi()
    {
        $result = $this->model('KoleksiModel')->create($_SESSION['user_id'], $_POST['buku_id']);
        // cek apakah yang dikembalikan lebih dari 0
        if ($result > 0) {
            $this->redirect('/lists/buku');
        } else {
            $this->redirect('/lists/buku');
        }
    }

    public function destroy_koleksi()
    {
        $result = $this->model('KoleksiModel')->delete($_POST['koleksi_id']);
        // cek apakah yang dikembalikan lebih dari 0
        if ($result > 0) {
            $this->redirect('/lists/buku');
        } else {
            $this->redirect('/lists/buku');
        }
    }

    public function store_ulasan()
    {
        $result = $this->model('UlasanBukuModel')->create($_POST);
        // cek apakah yang dikembalikan lebih dari 0
        if ($result > 0) {
            Flasher::setFlash('Ulasan berhasil dikirim!', 'success');
            $this->redirect('/lists/buku');
        } else {
            $this->redirect('/lists/buku');
        }
    }

    public function destroy_ulasan()
    {
        $result = $this->model('UlasanBukuModel')->delete($_POST['ulasan_id']);
        // cek apakah yang dikembalikan lebih dari 0
        if ($result > 0) {
            Flasher::setFlash('Ulasan berhasil dihapus!', 'success');
            $this->redirect('/lists/buku');
        } else {
            $this->redirect('/lists/buku');
        }
    }
}