<?php

declare(strict_types=1);

function index(): void
{
    if (!isset($_SESSION['user'])) {
        header('Location: /login');
        exit;
    }

    $user = $_SESSION['user'];
    $appName = $_ENV['APP_NAME'] ?? 'Sistema Genus';

    require dirname(__DIR__) . '/Views/home/index.php';
}