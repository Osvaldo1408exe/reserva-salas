<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: Login.php');
    exit();
}

include_once '../Controllers/ReservationController.php';

$reservations = new ReservationController();
$UserReservations = new ReservationController();
$reservations = $reservations->ListAllCurrentReservations();
$UserReservations = $UserReservations->listUserReservation();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    
    <link rel="stylesheet" href="../public/css/geral.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SysReserva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    <?php include './navbar.php'?>
    <div class="container mt-5">
        <div class="row">
            
            <div class="col-12">
                <div class="jumbotron text-center">
                    <h1 class="display-4">Bem-vindo ao Sistema de Gerenciamento de Salas</h1>
                    <p class="lead">Gerencie suas reservas de forma eficiente e prática.</p>
                </div>
            </div>
        </div>

        <?php if($_SESSION['role']=='user'):?>
            <div class="row">
                <!-- Reservas vigentes do usuario -->
                <div class="col-md-4">
                    <div class="card dashboard-card text-white bg-primary">
                        <div class="card-body">
                            <h5 class="card-title">Suas próximas Reservas </h5>
                                <ul class="list-unstyled">
                                    <?php if (!empty($UserReservations) && count($UserReservations) > 0): ?>    
                                        <?php
                                        foreach($UserReservations as $UserReservation){
                                            echo "<li>".$UserReservation['name']." - Check-in: ".$UserReservation['start_time']. "</li>";
                                        }
                                        ?>
                                    <?php else: ?>
                                        
                                        <li>Você não possui nenhuma reserva agendada.</li>
                                    
                                    <?php endif; ?>
                                </ul>
                        </div>
                    </div>
                </div>
                <!-- Próximas salas disponíveis -->
                <div class="col-md-4">
                    <div class="card dashboard-card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">Próximas salas disponíveis</h5>
                            <ul class="list-unstyled">
                                <?php if (!empty($reservations) && count($reservations) > 0): ?>    
                                    <?php
                                    foreach($reservations as $reservation){
                                        echo "<li>".$reservation['name']." - Check-out: ".$reservation['end_time']. "</li>";
                                    }
                                    ?>
                                <?php else: ?>
                                    
                                    <li>Todas as salas diponíveis.</li>
                                
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Acesso Rápido -->
                <div class="col-md-4">
                    <div class="card dashboard-card text-white bg-warning">
                        <div class="card-body">
                            <h5 class="card-title">Acesso Rápido</h5>
                            <a href="./Reservations.php" class="btn btn-light btn-sm">Nova Reserva</a>
                            <a href="./MyReservations.php" class="btn btn-light btn-sm">Minhas Reservas</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else:?>
           
            <h2>Funcionalidades Principais</h2>
            <ul class="list-group">
                <li class="list-group-item">
                    <h5>Gestão de Salas</h5>
                    <p>Adicione, edite e remova salas disponíveis para reserva. Visualize uma lista completa de todas as salas com detalhes como capacidade e localização.</p>
                </li>

                <li class="list-group-item">
                    <h5>Gestão de Reservas</h5>
                    <p>Visualize uma lista completa de todas as reservas com informações como usuário, sala, check-in e check-out</p>
                </li>
                
                 
                <li class="list-group-item">
                    <h5>Relatórios e Análises</h5>
                    <p>Vejá relatórios sobre o uso das salas, identificando padrões. Acesse dados para análise de tendências e planejamento futuro.</p>
                </li>
            </ul>    
            
                
                
            
        <?php endif;?>


       
            

        <footer class="bg-body-tertiary text-center fixed-footer">
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
                © 2024 Desenvolvido por:
                <a class="text-body" href="https://br.linkedin.com/in/osvaldo-protazio">Osvaldo Protazio</a>
            </div>
        </footer>

                

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body