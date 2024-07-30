<?php
class Room {
    public $conn;
    private $table = 'rooms';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAvailableRooms($startTime, $endTime) {
        $sql = "SELECT * FROM rooms WHERE id NOT IN (
                    SELECT room_id FROM reservations 
                    WHERE (start_time < ? AND end_time > ?)
                )";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $endTime, $startTime);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllRooms() {
        $sql = "SELECT * FROM " . $this->table;
        $result = $this->conn->query($sql);
        
        if ($result->num_rows > 0) {
            $rooms = [];
            while($row = $result->fetch_assoc()) {
                $rooms[] = $row;
            }
            return $rooms;
        } else {
            return [];
        }
    }

    public function createRoom($name, $capacity, $location) {
        $sql = "INSERT INTO " . $this->table . " (name, capacity, location) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $name, $capacity, $location);

        return $stmt->execute();
    }

    public function updateRoom($id, $name, $capacity, $location) {
        $sql = "UPDATE " . $this->table . " SET name = ?, capacity = ?, location = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $name, $capacity, $location, $id);

        return $stmt->execute();
    }

    public function deleteRoom($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
    
        return $stmt->execute();
    }
    
}
?>
