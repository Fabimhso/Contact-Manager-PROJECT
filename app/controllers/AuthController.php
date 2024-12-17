<?php
require_once '../app/models/User.php';
require_once '../app/core/Session.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
        Session::start();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($password) >= 6) {
                $this->userModel->register($name, $email, $password);
                header("Location: /login");
            } else {
                echo "Dados inválidos!";
            }
        } else {
            include '../app/views/register.php';
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->login($email, $password);
            if ($user) {
                Session::set('user_id', $user['id']);
                header("Location: /dashboard");
            } else {
                echo "Credenciais inválidas!";
            }
        } else {
            include '../app/views/login.php';
        }
    }

    public function logout() {
        Session::destroy();
        header("Location: /login");
    }
}