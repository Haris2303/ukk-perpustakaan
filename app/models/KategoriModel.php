<?php

class KategoriModel extends DBMysqli 
{
    protected $table = 'kategoribuku';

    private int $id;
    private string $namaKategori;

    public function get(): array
    {
        return $this->query("SELECT * FROM $this->table ORDER BY NamaKategori ASC");
    }

    public function getBy($id): array
    {
        return $this->query("SELECT * FROM $this->table WHERE KategoriID = $id")[0];
    }

    public function create($data)
    {
        $this->namaKategori = $data['namakategori'];

        // cek apakah kategori sudah di database
        $result = $this->query("SELECT NamaKategori FROM $this->table WHERE NamaKategori = '$this->namaKategori'")[0];
        if(is_array($result)) {
            return 'Data kategori telah tersedia!';
        }

        // tambahkan data
        mysqli_query($this->conn, "INSERT INTO $this->table VALUES(NULL, '$this->namaKategori')");

        return (mysqli_affected_rows($this->conn) > 0) ?? 'Data Gagal ditambahkan!';
    }

    public function update($data)
    {
        $this->id = $data['id'];
        $this->namaKategori = $data['namakategori'];

        // cek apakah kategori sudah di database
        $result = $this->query("SELECT NamaKategori FROM $this->table WHERE NamaKategori = '$this->namaKategori'")[0];
        if(is_array($result)) {
            return 'Data kategori telah tersedia!';
        }

        // update data
        mysqli_query($this->conn, "UPDATE $this->table SET 
            NamaKategori = '$this->namaKategori' 
            WHERE KategoriID = '$this->id'
        ");

        return (mysqli_affected_rows($this->conn) > 0) ?? 'Data Gagal diubah!';
    }

    public function delete($id)
    {
        mysqli_query($this->conn, "DELETE FROM $this->table WHERE KategoriID = $id");
        return mysqli_affected_rows($this->conn);
    }
}