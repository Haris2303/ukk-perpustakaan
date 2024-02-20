<?php

class DBMysqli {

    private $host = DBHOST;
    private $user = DBUSER;
    private $pass = DBPASS;
    private $dbname = DBNAME;

    protected $conn;

    public function __construct()
    {
        try {
            $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function query($query)
    {
        $result = mysqli_query($this->conn, $query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
}