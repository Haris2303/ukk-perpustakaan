<?php

class PeminjamanModel extends BaseModel
{
    protected $table = 'peminjaman';
    protected $view = 'view_peminjaman';

    private int $userId;
    private int $bukuId;
    private string $tanggalPeminjaman;
    private string $tanggalPengembalian;

    public function __construct()
    {
        parent::__construct();
    }

    public function get(): array
    {
        $this->selectData($this->view);
        return $this->fetchAll();
    }

    public function getBy($userId): array
    {
        $this->selectData(kondisi: ['UserID =' => $userId]);
        return $this->fetchAll();
    }

    public function create($data)
    {
        // isi data pada attribute
        $this->userId = $data['userId'];
        $this->bukuId = $data['bukuId'];
        $this->tanggalPeminjaman = $data['tanggal_peminjaman'];
        $this->tanggalPengembalian = $data['tanggal_pengembalian'];

        // tambahkan data
        $data = [
            'UserID' => $this->userId,
            'BukuID' => $this->bukuId,
            'TanggalPeminjaman' => $this->tanggalPeminjaman,
            'TanggalPengembalian' => $this->tanggalPengembalian,
            'StatusPeminjaman' => 'dipinjam'
        ];

        return $this->insertData($data) ?? 'Data gagal ditambahkan!';
    }
    
    public function update($id)
    {
        return $this->updateData([
            'StatusPeminjaman' => 'dikembalikan'
        ], ['PeminjamanID' => $id]);
    }

    public function delete($id)
    {
        return $this->deleteData(['PeminjamanID' => $id]);
    }
}