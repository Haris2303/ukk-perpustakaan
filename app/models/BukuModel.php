<?php

require_once __DIR__ . '/KategoriRelasiModel.php';

class BukuModel extends BaseModel
{
    protected $table = 'buku';

    protected string $judul;
    protected string $penulis;
    protected string $penerbit;
    protected string $tahunTerbit;
    protected $sampul;

    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $this->selectData();
        return $this->fetchAll();
    }

    public function getBy($id): array
    {
        $this->selectData(kondisi: ['BukuID =' => $id]);
        return $this->fetch();
    }

    public function create($post, $files)
    {
        $this->judul = $post['judul'];
        $this->penulis = $post['penulis'];
        $this->penerbit = $post['penerbit'];
        $this->tahunTerbit = $post['tahun_terbit'];
        $this->sampul = Utility::uploadImage($files, 'sampul');

        if (!is_string($this->sampul)) {
            return 'Gagal upload gambar';
        }

        // cek apakah judul buku sudah tersedia
        if ($this->isData(['Judul' => $this->judul])) {
            return 'Judul buku sudah tersedia!';
        }

        // tambahkan data
        $data = [
            'Judul' => $this->judul,
            'Penulis' => $this->penulis,
            'Penerbit' => $this->penerbit,
            'TahunTerbit' => $this->tahunTerbit,
            'Sampul' => $this->sampul
        ];

        if ($this->insertData($data)) {

            // ambil data id buku dari judul
            $this->selectData(kondisi: ['Judul =' => $this->judul]);
            $data_buku = $this->fetch();

            // Tambahkan data kategori pada kategoribuku_relasi
            for ($i = 0; $i < count($post['kategori']); $i++) {
                // initial kategorirelasimodel
                $kategoriRelasiModel = new KategoriRelasiModel();
                $kategoriRelasiModel->create($data_buku['BukuID'], (int)$post['kategori'][$i]);
            }

            return 1;
        }

        return 'Data gagal ditambahkan!';
    }

    public function update($post, $files)
    {
        $this->judul = $post['judul'];
        $this->penulis = $post['penulis'];
        $this->penerbit = $post['penerbit'];
        $this->tahunTerbit = $post['tahun_terbit'];
        $this->sampul = Utility::uploadImage($files, 'sampul');

        if (is_string($this->sampul)) {
            @unlink(LOCALE_URL . '/img/sampul/' . $post['gambarLama']);
        } else {
            $this->sampul = $post['gambarLama'];
        }

        // cek apakah judul buku sudah tersedia
        if (!$this->isData(['Judul' => $this->judul])) {
            if ($this->isData(['Judul' => $this->judul])) {
                return 'Judul buku sudah tersedia!';
            }
        }

        // tambahkan data
        $data = [
            'Judul' => $this->judul,
            'Penulis' => $this->penulis,
            'Penerbit' => $this->penerbit,
            'TahunTerbit' => $this->tahunTerbit,
            'Sampul' => $this->sampul
        ];

        $this->updateData($data, ['BukuID' => $post['id']]);

        // initial kategorirelasimodel
        $kategoriRelasiModel = new KategoriRelasiModel();

        // delete kategori buku berdasarkan id buku
        $kategoriRelasiModel->delete($post['id']);

        // Tambahkan data kategori pada kategoribuku_relasi
        for ($i = 0; $i < count($post['kategori']); $i++) {
            $kategoriRelasiModel->create($post['id'], (int)$post['kategori'][$i]);
        }

        return 1;
    }

    public function delete($id)
    {
        // initial kategorirelasimodel
        $kategoriRelasiModel = new KategoriRelasiModel();

        // delete kategori relasi
        $kategoriRelasiModel->delete($id);

        return $this->deleteData(['BukuID' => $id]);
    }
}
