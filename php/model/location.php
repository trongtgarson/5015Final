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

    return $locations;
  }


  public function findAllFor($userId) {
    $query = "SELECT id, latitude, longitude, date, userId FROM " . $this->table_name . " WHERE userId = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($id, $latitude, $longitude, $date, $userId);

    $locations = array();

    while($stmt->fetch()) {
      $locations[] = array(
        "id"=>$id,
        "latitude"=>$latitude,
        "longitude"=>$longitude,
        "date"=>$date,
        "userId"=>$userId,
      );
    }

    $stmt->close();
    return $locations;
  }

  public function findLatestFor($userId) {
    $query = "SELECT id, latitude, longitude, date, userId FROM " . 
      $this->table_name . " WHERE userId = ? ORDER BY date DESC LIMIT 1";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($id, $latitude, $longitude, $date, $userId);

    $location = json_decode('{}');

    if($stmt->fetch()) {
      $location = array(
        "id"=>$id,
        "latitude"=>$latitude,
        "longitude"=>$longitude,
        "date"=>$date,
      );
    }

    $stmt->close();
    return $location;
  }

  public function create($latitude, $longitude, $userId) {
    $sql = "INSERT INTO " . $this->table_name . " (latitude, longitude, userId, date) VALUES (?,?,?,now())";
    $stmt = $this->conn->prepare($sql);
    $now = 
      $stmt->bind_param("ddi", $latitude, $longitude, $userId);
    $stmt->execute();
    $created = false;
    if($stmt->affected_rows > 0) $created = true;
    $stmt->close();
    return $created;
  }
}

?>
