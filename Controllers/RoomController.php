<?php
require_once __DIR__ . '/../Models/DataBase.php';
require_once __DIR__ . '/../Models/Room.php';

class RoomController {
    private $roomModel;

    public function __construct() {
        $database = new Database();
        $this->roomModel = new Room($database->conn);
    }

    public function listRooms() {
        return $this->roomModel->getAllRooms();
    }

    public function addRoom($name, $capacity, $location) {
        return $this->roomModel->createRoom($name, $capacity, $location);
    }

    public function editRoom($id, $name, $capacity, $location) {
        return $this->roomModel->updateRoom($id, $name, $capacity, $location);
    }

    
    public function deleteRoom($id) {
        return $this->roomModel->deleteRoom($id);
    }
}


// Verificar se a requisição é AJAX e adiciona, atualiza ou deleta uma sala
if (isset($_GET['action'])) {
    $roomController = new RoomController();

    if ($_GET['action'] === 'add') {
        $name = $_POST['name'];
        $capacity = $_POST['capacity'];
        $location = $_POST['location'];
        $status = $roomController->addRoom($name, $capacity, $location) ? 'success' : 'error';
    } elseif ($_GET['action'] === 'edit') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $capacity = $_POST['capacity'];
        $location = $_POST['location'];
        $status = $roomController->editRoom($id, $name, $capacity, $location) ? 'success' : 'error';
    } elseif ($_GET['action'] === 'delete') {
        $id = $_POST['id'];
        $status = $roomController->deleteRoom($id) ? 'success' : 'error';
    }

    echo json_encode(['status' => $status]);
}

?>
