<?php

class User {
  private $conn;
  private $table_name = "users";

  public $id;
  public $username;

  public function __construct($db) {
    $this->conn = $db;
  }

  public function all() {
    $query = "SELECT id, username FROM " . $this->table_name;
    $result = $this->conn->query($query);

    $users = array();

    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $users[] = array(
          "id"=>$row["id"],
          "username"=>$row["username"]
        );
      }
    }

    return $users;
  }

  public function find($username) {
    $query = "SELECT * FROM " . $this->table_name . " WHERE username = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $user = null;
    if($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $user = array(
        "id"=>$row["id"],
        "username"=>$row["username"],
        "password"=>$row["password"]
      );
    }
    $stmt->close();
    return $user;
  }

  public function create($username, $password) {

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO " . $this->table_name . " (username,password) VALUES (?,?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashed);

    $stmt->execute();
    $created = false;
    if($stmt->affected_rows > 0) $created = true;
    $stmt->close();
    return $created;
  }
}

?>
