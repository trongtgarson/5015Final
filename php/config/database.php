<?php

class Database {

  private $host = "localhost";
  private $db_name = "wimc";
  private $username = "root";
  private $password = "jk4m3lD6";

  public function getConnection() {

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
      $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name); 
      $this->conn->set_charset("utf8");
    } catch(Exception $e) {
      error_log($e->getMessage());
      exit("Failed to connect to database");
    }

    return $this->conn;
  }

}

?>
