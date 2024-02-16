<?php

class Web extends Controller
{

  public function __construct()
  {
    if (!isset($_SESSION['is_login'])) {
      $this->redirect('/login');
      exit;
    }
  }

  /**
   * Menampilkan halaman beranda (home)
   * @method index
   */
  public function index(): void
  {
    if ($_SESSION['Role'] === 'peminjam') {
      $this->redirect('/lists/buku');
      exit;
    }
    
    $data = [
      "title" => "Home",
      "jumlahPetugas" => count($this->model('UserModel')->get('petugas')),
      "jumlahPeminjam" => count($this->model('UserModel')->get('peminjam')),
      "jumlahBuku" => count($this->model('BukuModel')->get()),
      "jumlahPeminjaman" => count($this->model('PeminjamanModel')->get())
    ];

    // Memanggil tampilan untuk menghasilkan halaman beranda
    $this->view('template/header', $data);
    $this->view('web/index', $data);
    $this->view('template/footer', $data);
  }

  public function do_logout()
  {
    session_unset();
    $_SESSION = [];
    session_destroy();
    header('Location: ' . BASEURL . '/login');
    exit;
  }
}
