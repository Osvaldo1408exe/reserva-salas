<?php
session_start();
require_once 'controllers/UserController.php';
require_once 'controllers/ReservationController.php';



$action = isset($_GET['action']) ? $_GET['action'] : '';

$Usercontroller = new UserController();
$ReservationController = new ReservationController();


switch ($action) {
    case 'register':
        $Usercontroller->register();
        break;
    case 'login':
        $Usercontroller->login();
        break;
    case 'logout':
        $Usercontroller->logout();
        break;
    default:
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit();
        }

}
?>
