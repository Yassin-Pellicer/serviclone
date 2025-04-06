<?php
require_once dirname(__DIR__) . '/config/Database.php';

class Session {
  private $conn;
  private $table = 'session';

  public function __construct() {
    $database = new Database();
    $this->conn = $database->connect();
  }

  public function getAll() {
    $query = "SELECT * FROM {this->table}";
    $result = $this->conn->prepare($query);
    $result->execute();

    return $result->fetchAll();
  }

  public function getByEventId($event_id) {
    $query = "SELECT event, hour, capacity, soldout, tickets, id
              FROM {$this->table} WHERE event = :event_id";
    $result = $this->conn->prepare($query);
    $result->bindParam(":event_id", $event_id);
    $result->execute();

    return $result->fetchAll();
  }

  public function getById($id) {
    $query = "SELECT event, hour, capacity, soldout, tickets, id
              FROM {$this->table} WHERE id = :id";
    $result = $this->conn->prepare($query);
    $result->bindParam(":id", $id);
    $result->execute();

    return $result->fetch();
  }

}