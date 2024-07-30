<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ./Login.php');
    exit();
}

include_once __DIR__ . '/../Controllers/ReservationController.php';

$reservationController = new ReservationController();
$reservations = $reservationController->listUserReservation();

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../public/css/geral.css">
    <title>SysReserva</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <h2 class="mt-4">Minhas reservas</h2>

        <!-- Modal para Confirmar Exclusão -->
        <?php include './modals/deleteReservationModal.php'; ?>
        

        <!-- Tabela de quartos -->
        <table class="table table-hover mt-5">
            <thead>
                <tr>
                    <th>Quarto</th>
                    <th>Início</th>
                    <th>Fim</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($reservations) && count($reservations) > 0): ?>
                    <?php foreach ($reservations as $reservation): ?>
                        <tr>
                            <td><?php echo $reservation['name']; ?></td>
                            <td><?php echo $reservation['start_time']; ?></td>
                            <td><?php echo $reservation['end_time']; ?></td>
                            <td>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $reservation['id']; ?>)" >Deletar <i class="fa-solid fa-x"></i></button>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">Nenhuma reserva encontrada.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <footer class="bg-body-tertiary text-center fixed-footer">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 Desenvolvido por:
            <a class="text-body" href="https://br.linkedin.com/in/osvaldo-protazio">Osvaldo Protazio</a>
        </div>
    </footer>
   

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="../public/js/deleteReservation.js"></script>

</body>
</html>
