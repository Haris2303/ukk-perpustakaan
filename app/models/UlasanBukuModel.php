<?php

class UlasanBukuModel extends BaseModel
{
    protected $table = 'ulasanbuku';
    protected $view = 'view_ulasan';

    private string $ulasan;
    private int $rating;

    public function __construct()
    {
        parent::__construct();
    }

    public function getByUserId($id)
    {
        $this->selectData(kondisi: ['UserID =' => $id]);
        return $this->fetchAll();
    }

    public function getByBukuId($id)
    {
        $this->selectData($this->view, kondisi: ['BukuID =' => $id]);
        return $this->fetchAll();
    }

    public function create($data)
    {
        $this->ulasan = $data['ulasan'];
        $this->rating = $data['rating'];

        return $this->insertData([
            'UserID' => $_SESSION['user_id'],
            'BukuID' => $data['buku_id'],
            'Ulasan' => $this->ulasan,
            'Rating' => $this->rating
        ]);
    }

    public function delete($id)
    {
        return $this->deleteData(['UlasanID' => $id]);
    }
}