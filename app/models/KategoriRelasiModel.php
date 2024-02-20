<?php

class KategoriRelasiModel extends DBMysqli
{
    protected $table = 'kategoribuku_relasi';
    protected $view = 'view_kategoribuku';

    public function get()
    {
        return $this->query("SELECT * FROM $this->view ORDER BY NamaKategori ASC");
    }

    public function getByBukuId($id)
    {
        return $this->query("SELECT * FROM $this->view WHERE BukuID = $id");
    }

    public function create($bukuId, $kategoriId)
    {
        mysqli_query($this->conn, "INSERT INTO $this->table VALUES(NULL, $bukuId, $kategoriId)");
        return mysqli_affected_rows($this->conn);
    }

    public function delete($bukuId) {
        mysqli_query($this->conn, "DELETE FROM $this->table WHERE BukuID = $bukuId");
        return mysqli_affected_rows($this->conn);
    }
} 