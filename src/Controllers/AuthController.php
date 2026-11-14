<?php

declare(strict_types=1);

use App\Config\Database;
use App\Models\UserModel;

function showLogin(): void
{
    if (isset($_SESSION['user'])) {
        header('Location: /home');
        exit;
    }

    $error = $_SESSION['flash_error'] ?? null;
    $oldEmail = $_SESSION['flash_old_email'] ?? '';
    unset($_SESSION['flash_error'], $_SESSION['flash_old_email']);

    $appName = $_ENV['APP_NAME'] ?? 'Sistema Genus';

    require dirname(__DIR__) . '/Views/auth/login.php';
}

function login(): void
{
    $email = trim((string) ($_POST['email'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        $_SESSION['flash_error'] = 'Por favor, completa todos los campos.';
        $_SESSION['flash_old_email'] = $email;
        header('Location: /login');
        exit;
    }

    $pdo = Database::getConnection();
    $userModel = new UserModel($pdo);
    $user = $userModel->findByEmail($email);

    if ($user === null || !password_verify($password, $user['password'])) {
        $_SESSION['flash_error'] = 'Correo electrónico o contraseña incorrectos.';
        $_SESSION['flash_old_email'] = $email;
        header('Location: /login');
        exit;
    }

    session_regenerate_id(true);

    $_SESSION['user'] = [
        'id'    => $user['id'],
        'name'  => $user['name'],
        'email' => $user['email'],
        'role'  => $user['role'],
    ];

    header('Location: /home');
    exit;
}

function logout(): void
{
    $_SESSION = [];
    session_destroy();

    header('Location: /login');
    exit;
}