<?php

include_once '../config/core.php';

class User {
  private $conn;
  private $table_name = "users";

  public function __construct($db) {
    $this->conn = $db;
  }

  public function all() {
    $query = "SELECT id, username, contactName FROM " . $this->table_name;
    $result = $this->conn->query($query);

    $users = array();

    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $users[] = array(
          "id"=>$row["id"],
          "username"=>$row["username"],
          "contactName"=>$row["contactName"],
        );
      }
    }

    return $users;
  }

  public function find($searchName) {
    $query = "SELECT id, username, contactName, password, activationCode, activatedAt FROM " . $this->table_name . " WHERE username = ? LIMIT 1";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $searchName);
    $stmt->execute();
    $result = $stmt->bind_result($id, $username, $contactName, $password, $activationCode, $activatedAt);

    $user = null;
    if($stmt->fetch()) {
      $user = array(
        "id"=>$id,
        "username"=>$username,
        "contactName" => $contactName,
        "password"=>$password,
        "activationCode"=>$activationCode,
        "activatedAt"=>$activatedAt
      );
    }
    $stmt->close();
    return $user;
  }

  public function create($username, $password, $contactName) {

    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $activationCode = sprintf("%08d", mt_rand(0, 99999999));

    $sql = "INSERT INTO " . $this->table_name . " (username,password,contactName,activationCode,activatedAt) VALUES (?,?,?,?,NULL)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $hashed, $contactName, $activationCode);

    $stmt->execute();
    $created = ($stmt->affected_rows > 0);
    $stmt->close();

    // TODO: Remove this once email works
    $_SESSION["activationCode"] = $activationCode;

    return $created;
  }

  public function sendActivationCode($username) {

  }

  public function activateNow($user) {
    $sql = "UPDATE " . $this->table_name . " SET activatedAt=NOW() WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("d", $user["id"]);

    $stmt->execute();
    $updated = ($stmt->affected_rows > 0);
    $stmt->close();

    return $updated;

  }
}

?>
