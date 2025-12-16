<?php
// controllers/AuthController.php

class AuthController                                   // la clase AuthController contiene un objeto usuario (el que autentica)
{
    private $userModel;

    public function __construct()                     // aquí lo crea
    {
        $this->userModel = new Usuario();
    }

    public function login()                           // aquí ejecuta el login (en realidad, la vista login)
    {
        // Carga la vista del formulario de login
        include 'vista/login.php';
    }

    public function authenticate()                    // aquí confronta con la base de datos
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) 
            {
                $username = $_POST['idusuario'];
                $password = $_POST['password'];

                if ($this->userModel->login($username, $password)) {
                    // Autenticación exitosa, iniciar sesión y redirigir al enrutador para que éste envíe al dashboard-inicio
                    $_SESSION['idusuario'] = $username;
                    header('Location: index.php?action=dashboard');
                    exit();
                } else {
                    // Autenticación fallida, recargar login con error que mostraría mensaje
                    $_GET['error'] = "Usuario o contraseña incorrectos.";
                    include 'vista/login.php';
                }
            }
            else
            {
                die("Solicitud no válida. Token CSRF no coincide.");
            }
        }
    }

    public function dashboard()
    {
        // Verificar si el usuario ha iniciado sesión
        if (!isset($_SESSION['idusuario'])) {
            header('Location: index.php?action=login');
            exit();
        }
        // Carga la vista del dashboard (página de bienvenida)
        include 'vista/dashboard.php';
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        if (isset($_COOKIE[session_name()])) 
        {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', 1, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
        }
        header('Location: index.php?action=login');
        exit();
    }
}