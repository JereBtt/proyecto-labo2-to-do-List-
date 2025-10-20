<?php

class loginController
{
    function __construct() {}


    function index()
    {

        session_start();

        $_POST = [
            'usuario' => trim($_POST['usuario'] ?? ''),
            'contrasenia' => trim($_POST['contrasenia'] ?? ''),
        ];


        if ($_POST) {
            $usuarioCorrecto = "123";
            $contraseniaCorrecta = "123";

            $usuario = $_POST['usuario'];
            $contrasenia = $_POST['contrasenia'];

            if ($usuario == $usuarioCorrecto && $contrasenia == $contraseniaCorrecta) {
                $_SESSION['usuario'] = $usuarioCorrecto;
                header("Location: home");
                exit();
            } else {
                echo '<div class="alert alert-danger text-center" role="alert">
                Usuario o contraseña incorrecta
              </div>';
            }
        }
        View::render('loginview');
    }

    function logout()
    {
        session_start();
        session_destroy();
        // header("Location: login");
        View::render('loginview');
        exit();
    }
}
