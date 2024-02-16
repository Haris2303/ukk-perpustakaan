<?php

class KategoriModel extends BaseModel 
{
    protected $table = 'kategoribuku';
    protected string $namaKategori;

    public function __construct()
    {
        parent::__construct();
    }

    public function get(): array
    {
        $this->selectData(orderBy: ['NamaKategori' => 'ASC']);
        return $this->fetchAll();
    }

    public function getBy($id): array
    {
        $this->selectData(kondisi: ['KategoriID =' => $id]);
        return $this->fetch();
    }

    public function create($data)
    {
        $this->namaKategori = $data['namakategori'];

        // cek apakah kategori sudah di database
        if($this->isData(['NamaKategori' => $this->namaKategori])) {
            return 'Data kategori telah tersedia!';
        }

        // tambahkan data
        return $this->insertData([
            'NamaKategori' => $this->namaKategori
        ]) ? 1 : 'Data Gagal ditambahkan!';
    }

    public function update($data)
    {
        $this->namaKategori = $data['namakategori'];

        // cek apakah kategori sudah di database
        if($this->isData(['NamaKategori' => $this->namaKategori])) {
            return 'Data kategori telah tersedia!';
        }

        // update data
        return $this->updateData([
            'NamaKategori' => $this->namaKategori
        ], ['KategoriID' => $data['id']]) ? 1 : 'Data Gagal diubah!';
    }

    public function delete($id)
    {
        return $this->deleteData(['KategoriID' => $id]);
    }
}