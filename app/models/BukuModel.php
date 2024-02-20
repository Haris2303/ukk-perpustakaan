<?php

require_once __DIR__ . '/KategoriRelasiModel.php';

class BukuModel extends DBMysqli
{
    protected $table = 'buku';

    protected int $id;
    protected string $judul;
    protected string $penulis;
    protected string $penerbit;
    protected string $tahunTerbit;
    protected $sampul;

    public function get()
    {
        return $this->query("SELECT * FROM $this->table");
    }

    public function getBy($id): array
    {
        return $this->query("SELECT * FROM $this->table WHERE BukuID = $id")[0];
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
        $result = $this->query("SELECT Judul FROM $this->table WHERE Judul = '$this->judul'")[0];
        if (is_array($result)) {
            return 'Judul buku sudah tersedia!';
        }

        // tambahkan data
        mysqli_query($this->conn, "INSERT INTO $this->table VALUES(
            NULL, 
            '$this->judul', 
            '$this->penulis', 
            '$this->penerbit', 
            '$this->tahunTerbit', 
            '$this->sampul'
        )");

        // jika record lebih dari 0
        if (mysqli_affected_rows($this->conn) > 0) {

            // ambil data id buku dari judul
            $data_buku = $this->query("SELECT BukuID FROM $this->table WHERE Judul = '$this->judul'")[0];

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
        $this->id = $post['id'];
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
        if ($post['judulLama'] !== $this->judul) {
            $result = $this->query("SELECT Judul FROM $this->table WHERE Judul = '$this->judul'")[0];
            if (is_array($result)) {
                return 'Judul buku sudah tersedia!';
            }
        }

        // update data
        mysqli_query($this->conn, "UPDATE $this->table SET 
            Judul = '$this->judul',
            Penulis = '$this->penulis',
            Penerbit = '$this->penerbit',
            TahunTerbit = '$this->tahunTerbit',
            Sampul = '$this->sampul'
            WHERE BukuID = $this->id
        ");

        // initial kategorirelasimodel
        $kategoriRelasiModel = new KategoriRelasiModel();

        // delete kategori buku berdasarkan id buku
        $kategoriRelasiModel->delete($post['id']);

        // Tambahkan data kategori pada kategoribuku_relasi
        for ($i = 0; $i < count($post['kategori']); $i++) {
            $kategoriRelasiModel->create($this->id, (int)$post['kategori'][$i]);
        }

        return 1;
    }

    public function delete($id)
    {
        // initial kategorirelasimodel
        $kategoriRelasiModel = new KategoriRelasiModel();

        // delete kategori relasi
        $kategoriRelasiModel->delete($id);

        // hapus sampul lama di local
        $row = $this->query("SELECT Sampul FROM $this->table WHERE BukuID = $id")[0];
        @unlink(LOCALE_URL . '/img/sampul/' . $row['Sampul']);

        // delete data
        mysqli_query($this->conn, "DELETE FROM $this->table WHERE BukuID = $id");
        
        return mysqli_affected_rows($this->conn);
    }
}
