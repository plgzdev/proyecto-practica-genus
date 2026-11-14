<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | <?= htmlspecialchars($appName) ?></title>
</head>
<body>
    <header>
        <h1><?= htmlspecialchars($appName) ?></h1>
        <p>
            Bienvenido, <strong><?= htmlspecialchars($user['name']) ?></strong>
            (Rol: <?= htmlspecialchars($user['role']) ?>)
        </p>

        <form action="/logout" method="POST">
            <button type="submit">Cerrar sesión</button>
        </form>
    </header>

    <main>
        <h2>Página Principal</h2>
        <p>Has iniciado sesión correctamente en el sistema clínico.</p>
    </main>
</body>
</html>