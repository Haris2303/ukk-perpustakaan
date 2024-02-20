<?php

class PeminjamanModel extends DBMysqli
{
    protected $table = 'peminjaman';
    protected $view = 'view_peminjaman';

    private int $userId;
    private int $bukuId;
    private string $tanggalPeminjaman;
    private string $tanggalPengembalian;

    public function get(): array
    {
        return $this->query("SELECT * FROM $this->view");
    }

    public function getBy($userId): array
    {
        return $this->query("SELECT * FROM $this->view WHERE UserID = $userId");
    }

    public function create($data)
    {
        // isi data pada attribute
        $this->userId = $data['userId'];
        $this->bukuId = $data['bukuId'];
        $this->tanggalPeminjaman = $data['tanggal_peminjaman'];
        $this->tanggalPengembalian = $data['tanggal_pengembalian'];

        // tambahkan data
        mysqli_query($this->conn, "INSERT INTO $this->table VALUES(
            NULL, 
            '$this->userId',
            '$this->bukuId',
            '$this->tanggalPeminjaman',
            '$this->tanggalPengembalian',
            'dipinjam'
        )");

        return (mysqli_affected_rows($this->conn)) ?? 'Data gagal ditambahkan!';
    }
    
    public function update($id)
    {
        mysqli_query($this->conn, "UPDATE $this->table SET StatusPeminjaman = 'dikembalikan' WHERE PeminjamanID = $id");
        return mysqli_affected_rows($this->conn);
    }

    public function delete($id)
    {
        mysqli_query($this->conn, "DELETE FROM $this->table WHERE PeminjamanID = $id");
        return mysqli_affected_rows($this->conn);
    }
}