<?php
require_once 'models/Database.php';
require_once 'models/User.php';

class UserController {
    private $userModel;

    public function __construct() {
        $database = new Database();
        $this->userModel = new User($database->conn);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            if ($this->userModel->register($username, $email, $password, $role)) {
                require_once 'views/Login.php';
            } else {
                echo "Erro ao cadastrar usuário.";
            }
        } else {
            require_once 'views/register.php';
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            // Verifica se o login é bem-sucedido e obtém os dados do usuário
            $user = $this->userModel->login($email, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user'] = $user['email'];
                $_SESSION['role'] = $user['access_level']; // Salva o nivel de acesso do usuário na sessão
    
               
                if ($user['role'] == 'admin') {
                    header('Location: Views/RoomsAdmin.php');
                } else {
                    header('Location: Views/Home.php');
                }
                exit();
            } else {
                echo "Usuário/senha incorretos";
            }
        } else {
            require_once 'views/login.php';
        }
    }
    
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: index.php?action=login');
        exit();
    }
    
}
?>
