<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ./Login.php');
    exit();
}

include_once __DIR__ . '/../Controllers/RoomController.php';
include_once __DIR__ . '/../Controllers/ReservationController.php';

$roomController = new RoomController();
$rooms = $roomController->listRooms();

$reservationController = new ReservationController();
$reservations = $reservationController->ListAllCurrentReservations();

if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}

if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>SysReserva</title>
    <link rel="stylesheet" href="../public/css/geral.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <h2 class="mt-4">Salas para reservas</h2>
        <!-- Modal para Adicionar Reserva -->
        <?php include 'modals/addReservationModal.php'; ?>

        <!-- Botão para abrir o modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReservationModal">
            Adicionar Reserva
        </button>

        <!-- Tabela de Salas -->
        <table class="table table-hover mt-5">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Capacidade</th>
                    <th>Localização</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($rooms) && count($rooms) > 0): ?>
                    <?php foreach ($rooms as $room): ?>
                        <tr>
                            <td><?php echo $room['name']; ?></td>
                            <td><?php echo $room['capacity']; ?></td>
                            <td><?php echo $room['location']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">Nenhuma sala encontrada.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>


    <!-- Horarios indiponiveis -->
    <div class="d-flex justify-content-center mt-5">
        <div class="card dashboard-card text-white bg-danger">
            <div class="card-body">
                <h5 class="card-title">Horários indiponiveís</h5>
                <ul class="list-unstyled">
                    <?php if (!empty($reservations) && count($reservations) > 0): ?>    
                        <?php
                        foreach($reservations as $reservation){
                            echo "<li>".$reservation['name']." - Check-out: ".$reservation['start_time']." - Check-out: ".$reservation['end_time']. "</li>";
                        }
                        ?>
                    <?php else: ?>
                        
                        <li>Todas as salas diponíveis.</li>
                    
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>


    <footer class="bg-body-tertiary text-center fixed-footer">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 Desenvolvido por:
            <a class="text-body" href="https://br.linkedin.com/in/osvaldo-protazio">Osvaldo Protazio</a>
        </div>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="../public/js/addReservation.js"></script>
</body>
</html>
