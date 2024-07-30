<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: Login.php');
    exit();
}
if($_SESSION['role'] != 'admin'){
    header('Location: Home.php');
}

include_once '../Controllers/ReservationController.php';
$reservationController = new ReservationController();
$reservationData = $reservationController->ListAllReservationsDashboard();

$rooms = array_column($reservationData, 'name');
$reservations = array_column($reservationData, 'reservas');

$calendarEvents = [];
foreach ($reservationData as $data) {
    $calendarEvents[] = [
        'title' => $data['name'],
        'start' => $data['start_time'],
        'end' => $data['end_time']
    ];
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/geral.css">
    <title>SysReserva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../public/js/chart.js"></script>  
    <script src="../public/js/calendary.js"></script>  
</head>
<body>
    <?php include './navbar.php'?>
    <div class="container mt-5">
        <div class="row">
        <div class="row">
            <!-- Relatórios e Análises -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Reservas por sala</h5>
                        <canvas id="RoomMostReservated"></canvas>
                    </div>
                </div>
            </div>
 
                

            <!-- Calendário de Reservas -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Calendário de Reservas</h5>
                        <div id="CalendaryReservations"></div>
                    </div>
                </div>
            </div>
        </div>

    <footer class="bg-body-tertiary text-center fixed-footer">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 Desenvolvido por:
            <a class="text-body" href="https://br.linkedin.com/in/osvaldo-protazio">Osvaldo Protazio</a>
        </div>
    </footer>           

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- FullCalendar -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // calendário
            initializeCalendar(<?php echo json_encode($calendarEvents); ?>);

            // gráfico de reservas
            createReservationsChart(<?php echo json_encode($rooms); ?>, <?php echo json_encode($reservations); ?>);
        });
    </script>
</body