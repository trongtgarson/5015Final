<?php

include_once '../config/core.php';

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
          "lat"=>(float)$row["latitude"],
          "lng"=>(float)$row["longitude"],
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
        "lat"=>(float)$latitude,
        "lng"=>(float)$longitude,
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

    $location = array();

    if($stmt->fetch()) {
      $location["id"] = $id;
      $location["lat"] = (float)$latitude;
      $location["lng"] = (float)$longitude;
      $location["date"] = $date;
    }

    $stmt->close();
    return json_encode($location);
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
