<?php

class KategoriRelasiModel extends BaseModel
{
    protected $table = 'kategoribuku_relasi';
    protected $view = 'view_kategoribuku';
    
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $this->selectData($this->view, orderBy: ['NamaKategori' => 'ASC']);
        return $this->fetchAll();
    }

    public function getByBukuId($id)
    {
        $this->selectData($this->view, kondisi: ['BukuID =' => $id]);
        return $this->fetchAll();
    }

    public function create($bukuId, $kategoriId)
    {
        return $this->insertData([
            'BukuID' => $bukuId,
            'KategoriID' => $kategoriId
        ]);
    }

    public function delete($bukuId) {
        return $this->deleteData(['BukuID' => $bukuId]);
    }
} 