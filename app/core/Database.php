<?php

class Database {

  private $host = DBHOST, $user = DBUSER, $pass = DBPASS, $dbname = DBNAME;
  private $dbh; // database handler
  private $stmt; // statement

  // koneksi ke database
  public function __construct()
  {
    // data source name
    $dsn = "mysql:host=$this->host;dbname=$this->dbname";

    // optimasi koneksi database
    $options = [
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION
    ];

    // cek koneksi
    try {
      $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
    } catch(PDOException $e) {
      die($e->getMessage());
    }
  }

  // make query
  /**
   * @param string $query berisikan perintah sql yang bertipe string example `SELECT * FROM table` atau lainnya
   * @var prepare $query
   */
  public function query($query): void {
    $this->stmt = $this->dbh->prepare($query);
  }

  // binding data
  public function bind($param, $value, $type = null): void {
    if( is_null($type) ) {
      switch( true ) {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default: 
          $type = PDO::PARAM_STR;
      }
    }

    $this->stmt->bindValue($param, $value, $type);
  }

  public function execute(): void {
    $this->stmt->execute();
  }

  public function resultSet(): array {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function single(): array|bool {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function rowCount(): int {
    return $this->stmt->rowCount();
  }
  
}