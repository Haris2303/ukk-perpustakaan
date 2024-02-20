<?php

class UlasanBukuModel extends DBMysqli
{
    protected $table = 'ulasanbuku';
    protected $view = 'view_ulasan';

    private int $userID;
    private int $bukuID;
    private string $ulasan;
    private int $rating;

    public function getByUserId($id)
    {
        return $this->query("SELECT * FROM $this->table WHERE UserID = $id");
    }

    public function getByBukuId($id)
    {
        return $this->query("SELECT * FROM $this->view WHERE BukuID = $id");
    }

    public function create($data)
    {
        
        $this->userID = $_SESSION['user_id'];
        $this->bukuID = $data['buku_id'];
        $this->ulasan = $data['ulasan'];
        $this->rating = $data['rating'];

        mysqli_query($this->conn, "INSERT INTO $this->table VALUES(
            NULL, 
            $this->userID,
            $this->bukuID,
            '$this->ulasan',
            '$this->rating'
        )");

        return mysqli_affected_rows($this->conn);
    }

    public function delete($id)
    {
        mysqli_query($this->conn, "DELETE FROM $this->table WHERE UlasanID = $id");
        return mysqli_affected_rows($this->conn);
    }
}