<?php

include_once 'core.php';

class Database {

  public function getConnection() {

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
      $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_SCHEMA); 
      $this->conn->set_charset("utf8");
    } catch(Exception $e) {
      error_log($e->getMessage());
      exit("Failed to connect to database");
    }

    return $this->conn;
  }

}

?>
