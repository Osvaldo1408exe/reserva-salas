<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ./Login.php');
    exit();
}
//verificação de nivel
if($_SESSION['role'] != 'admin'){
    header('Location: Home.php');
}


include_once __DIR__ . '/../Controllers/RoomController.php';

$roomController = new RoomController();
$rooms = $roomController->listRooms();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../public/css/geral.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SysReserva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- navbar -->
    <?php include './navbar.php'; ?>

    <!-- Modal para Adicionar um Quarto -->
    <?php include './modals/addRoomModal.php'; ?>

    <!-- Modal para Editar Quarto -->
    <?php include './modals/alterRoomModal.php'; ?>

    <!-- Modal para Confirmar Exclusão -->
    <?php include './modals/deleteRoomModal.php'; ?>

    <div class="container">
        <h2 class="mt-4">Lista de Salas</h2>
        <!-- Botão para abrir o modal de adição de quarto -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addRoomModal">
            Adicionar Sala
        </button>
        
        <!-- Tabela de quartos -->
        <table class="table table-hover mt-5">
            <thead>
                <tr>
                   
                    <th>Nome</th>
                    <th>Capacidade</th>
                    <th>Localização</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($rooms) && count($rooms) > 0): ?>
                    <?php foreach ($rooms as $room): ?>
                        <tr>
                            
                            <td><?php echo $room['name']; ?></td>
                            <td><?php echo $room['capacity']; ?></td>
                            <td><?php echo $room['location']; ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editRoom(<?php echo htmlspecialchars(json_encode($room)); ?>)">Editar <i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $room['id']; ?>)">Deletar <i class="fa-solid fa-x"></i></button>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Nenhuma sala encontrada.</td>
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
    <script src="../public/js/addRoom.js"></script>
    <script src="../public/js/alterRoom.js"></script>
    <script src="../public/js/deleteRoom.js"></script>

</body>
</html>
