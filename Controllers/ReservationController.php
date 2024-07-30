<?php
require_once __DIR__ . '/../Models/DataBase.php';
require_once __DIR__ . '/../Models/Reservation.php';

class ReservationController {
    private $reservationModel;

    public function __construct() {
        $database = new Database();
        $this->reservationModel = new ReservationModel($database->conn);
    }

    public function listUserReservation() {
        $userId = $_SESSION['user_id'];
        return $this->reservationModel->getUserReservations($userId);
    }

    public function listAllReservations() {
        return $this->reservationModel->getAllReservations();
    }

    public function ListAllCurrentReservations(){
        return $this->reservationModel->getAllCurrentReservations();
    }

    public function ListAllReservationsDashboard(){
        return $this->reservationModel->getAllReservationsDashboard();
    }
    
    public function createReservation() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            session_start();
            $roomId = $_POST['room'];
            $userId = $_SESSION['user_id'];
            $startTime = $_POST['start_time'];
            $endTime = $_POST['end_time'];

            $result = $this->reservationModel->createReservation($roomId, $userId, $startTime, $endTime);

            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Reserva criada com sucesso!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Conflito de horário! A sala já está reservada para o horário selecionado.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Método não permitido.']);
        }
    }

    public function deleteReservation($id) {
        return $this->reservationModel->deleteReservation($id);
    }
}

// Verificar se a requisição é AJAX e cria uma reserva
if (isset($_GET['action'])) {
    $reservationController = new ReservationController();

    if ($_GET['action'] === 'add') {
        $reservationController->createReservation();
    } elseif ($_GET['action'] === 'delete') {
        $id = $_POST['id'];
        $status = $reservationController->deleteReservation($id) ? 'success' : 'error';
        echo json_encode(['status' => $status]);
    }
}
?>
