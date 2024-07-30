<?php
class ReservationModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    //todas as reservas do usuario atualmente autenticado
    public function getUserReservations($userId) {
        $sql = "SELECT rooms.name, reservations.*,DATE_FORMAT(start_time, '%d/%m/%Y %H:%i:%s') as start_time, DATE_FORMAT(end_time, '%d/%m/%Y %H:%i:%s') as end_time FROM reservations JOIN rooms ON reservations.room_id = rooms.id WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
    //todas as reservas vigentes
    public function getAllCurrentReservations() {
        $sql = "SELECT reservations.*,rooms.name, DATE_FORMAT(start_time, '%d/%m/%Y %H:%i:%s') as start_time, DATE_FORMAT(end_time, '%d/%m/%Y %H:%i:%s') as end_time 
        FROM reservations 
        Join rooms on reservations.room_id = rooms.id 
        WHERE end_time > CURRENT_TIMESTAMP
        ORDER BY end_time ";
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

    //todas as reservas atuais para administração
    public function getAllReservations() {
        $sql = "SELECT reservations.*,rooms.name,users.name as username, DATE_FORMAT(start_time, '%d/%m/%Y %H:%i:%s') as start_time, DATE_FORMAT(end_time, '%d/%m/%Y %H:%i:%s') as end_time FROM reservations
        Join rooms on reservations.room_id = rooms.id
        Join users on reservations.user_id = users.id
        ORDER BY end_time";
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

    //contagem de quantas reservas feitas por salas
    public function getAllReservationsDashboard() {
        $sql = "SELECT reservations.*,rooms.name, COUNT(*) as reservas 
        FROM reservations
        Join rooms on reservations.room_id = rooms.id
        GROUP BY rooms.name ORDER BY reservas DESC";
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

 

    public function createReservation($roomId, $userId, $startTime, $endTime) {
        if ($this->hasConflict($roomId, $startTime, $endTime)) {
            return false; // Conflito de horário
        }

        $sql = "INSERT INTO reservations (room_id, user_id, start_time, end_time) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $this->conn->error);
        }
        $stmt->bind_param("iiss", $roomId, $userId, $startTime, $endTime);

        return $stmt->execute();
    }

    //verifica se existe uma reserva na data marcada evitando conflito
    public function hasConflict($roomId, $startTime, $endTime) {
        $sql = "SELECT COUNT(*) AS count FROM reservations WHERE room_id = ? AND (start_time < ? AND end_time > ?)";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $this->conn->error);
        }
        $stmt->bind_param("iss", $roomId, $endTime, $startTime);
        $stmt->execute();
    
        if ($stmt->error) {
            die("Erro na execução da consulta: " . $stmt->error);
        }
    
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'] > 0;
    }

    public function deleteReservation($id) {
        $sql = "DELETE FROM reservations WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
    
        return $stmt->execute();
    }
}
?>
