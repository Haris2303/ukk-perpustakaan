<?php

class KoleksiModel extends BaseModel
{
    protected $table = 'koleksipribadi';
    protected $view = 'view_koleksibuku';

    public function __construct()
    {
        parent::__construct();
    }

    public function getBy($userId): array
    {
        $this->selectData(kondisi: ['UserID =' => $userId]);
        return $this->fetchAll();
    }

    public function getViewBy($userId): array
    {
        $this->selectData($this->view, kondisi: ['UserID =' => $userId]);
        return $this->fetchAll();
    }

    public function create($userId, $bukuId)
    {
        return $this->insertData([
            'UserID' => $userId,
            'BukuID' => $bukuId
        ]);
    }

    public function delete($id)
    {
        return $this->deleteData(['KoleksiID' => $id]);
    }
}