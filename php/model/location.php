<?php

class location {
  private $conn;
  private $table_name = "locations";

  public $id;
  public $latitude;
  public $longitude;

  public function __construct($db) {
    $this->conn = $db;
  }

  public function all() {
    $query = "SELECT id, latitude, longitude, date, userId FROM " . $this->table_name;
    $result = $this->conn->query($query);

    $locations = array();

    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $locations[] = array(
          "id"=>$row["id"],
          "latitude"=>$row["latitude"],
          "longitude"=>$row["longitude"],
          "date"=>$row["date"],
          "userId"=>$row["userId"]
        );
      }
    }

    return $users;
  }

  public function findAllFor($userId) {
    $query = "SELECT id, latitude, longitude, date, userId FROM " . $this->table_name . " WHERE userId = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    $locations = array();

    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $locations[] = array(
          "id"=>$row["id"],
          "latitude"=>$row["latitude"],
          "longitude"=>$row["longitude"],
          "date"=>$row["date"],
          "userId"=>$row["userId"]
        );
      }
    }

    $stmt->close();
    return $locations;
  }

  public function create($latitude, $longitude, $userId) {

    $sql = "INSERT INTO " . $this->table_name . " (,password) VALUES (?,?)";
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

}

?>
