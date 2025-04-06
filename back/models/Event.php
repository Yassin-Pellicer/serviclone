<?php
require_once dirname(__DIR__) . '/config/Database.php';

class Event {
    private $conn; 
    private $table = 'event';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAll() {
        $query = "SELECT id, name, description, date, price, location, banner, soldout, past FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $query = "SELECT id, name, description, date, price, location, banner, soldout, past 
                 FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch();
    }

    public function getUpcoming() {
        $query = "SELECT id, name, description, date, price, location, banner, soldout, past 
                 FROM {$this->table} WHERE past = false ORDER BY date ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
}
