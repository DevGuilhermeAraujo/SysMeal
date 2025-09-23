<?php
// views/includes/header.php
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($titulo) ? $titulo . " | Sistema de Doações" : "Sistema de Doações" ?></title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Ícones Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Estilos customizados -->
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <!-- Logo / título -->
            <a class="navbar-brand fw-bold" href="index.php">
                <i class="bi bi-heart-fill"></i> Sistema de Doações
            </a>

            <!-- Botão mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/sysmeal/home">
                            <i class="bi bi-house-door"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/sysmeal/doador/listar">
                            <i class="bi bi-people"></i> Doadores
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/sysmeal/instituicao/listar">
                            <i class="bi bi-building"></i> Instituições
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/sysmeal/doacao/listar">
                            <i class="bi bi-box-seam"></i> Doações
                        </a>
                    </li>
                </ul>

                <!-- Dropdown de usuário (exemplo futuro) -->
                <ul class="navbar-nav ms-3">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> Usuário
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Perfil</a></li>
                            <li><a class="dropdown-item" href="#">Configurações</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="#">Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Container principal -->
    <main class="container my-4">