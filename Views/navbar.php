<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SysReserva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/42868b9ddf.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand ms-2" href="./Home.php"><i class="fa-solid fa-house"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="./Home.php">Início</a>
                </li>

                <?php if($_SESSION['role'] == 'admin'):?>
                    <li class="nav-item">
                        <a class="nav-link" href="./RoomsAdm.php">Salas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./ReservationsAdm.php">Reservas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Dashboards.php">Dashboard</a>
                    </li>
                <?php else:?>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="./Reservations.php">Reservar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./MyReservations.php">Minhas reservas</a>
                    </li>
                <?php endif;?>


                <li class="nav-item">
                    <a class="nav-link" href="../index.php?action=logout">Sair <i class="fa-solid fa-right-from-bracket"></i></a>
                </li>
            </ul>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
