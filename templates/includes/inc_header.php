<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] != "123") {
    header("Location: login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title><?php echo isset($d->title) ? $d->title . ' - ' . get_sitename() : 'Bienvenido ' . get_sitename(); ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* CSS personalizado para el todo list */
        .code-example {
            border-left: 4px solid #0d6efd;
        }

        .todo-item {
            transition: all 0.3s ease;
        }

        .todo-item:hover {
            background-color: #f8f9fa;
        }

        .priority-badge {
            font-size: 0.75rem;
        }

        .completed-task {
            opacity: 0.7;
        }

        .check-fav .fa-star {
            transition: transform .15s ease-in-out;
            font-size: 1.2rem;
        }

        .check-fav:hover .fa-star {
            transform: scale(1.15);
        }

        .check-complete:hover {
            transform: scale(1.15);
        }

        .check-complete {
            border: 2.5px solid #000000ff !important;
            width: 1.1em;
            height: 1.1em;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .check-complete:checked {
            background-color: #0d6efd !important;
            border-color: #0d6efd !important;
            box-shadow: 0 0 4px rgba(13, 110, 253, 0.5);
        }
    </style>
</head>

<body class="<?php echo isset($d->bg) && $d->bg === 'dark' ? 'bg-dark text-white' : 'bg-light' ?> py-3">

    <!-- Navegación principal -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="<?= URL ?>">
                <?= get_sitename() ?>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>">
                            Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>todo">
                            Todo List
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>todo/add">
                            Nueva Tarea
                        </a>
                        <a class="nav-link" href="<?= URL ?>login/logout">
                            Cerrar sesion
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenedor principal -->
    <div class="container">
        <!-- ends inc_header.php -->