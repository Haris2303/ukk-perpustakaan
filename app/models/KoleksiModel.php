<?php

class KoleksiModel extends DBMysqli
{
    protected $table = 'koleksipribadi';
    protected $view = 'view_koleksibuku';

    public function getBy($userId): array
    {
        return $this->query("SELECT * FROM $this->table WHERE UserID = $userId");
    }

    public function getViewBy($userId): array
    {
        return $this->query("SELECT * FROM $this->view WHERE UserID = $userId");
    }

    public function create($userId, $bukuId)
    {
        mysqli_query($this->conn, "INSERT INTO $this->table VALUES(NULL, $userId, $bukuId)");
        return mysqli_affected_rows($this->conn);
    }

    public function delete($id)
    {
        mysqli_query($this->conn, "DELETE FROM $this->table WHERE KoleksiID = $id");
        return mysqli_affected_rows($this->conn);
    }
}