<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | <?= htmlspecialchars($appName, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
    <main class="login-wrapper">
        <section class="login-card">
            <header class="login-header">
                <div class="brand-badge">SG</div>
                <h1><?= htmlspecialchars($appName, ENT_QUOTES, 'UTF-8') ?></h1>
                <p>Ingresa tus credenciales para continuar</p>
            </header>

            <?php if ($error !== null): ?>
                <div class="alert-error" role="alert">
                    <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                </div>
            <?php endif; ?>

            <form action="/login" method="POST" class="login-form" novalidate>
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="<?= htmlspecialchars($oldEmail, ENT_QUOTES, 'UTF-8') ?>"
                        placeholder="usuario@genus.com"
                        required
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        required
                    >
                </div>

                <button type="submit" class="btn-primary">Ingresar al sistema</button>
            </form>
        </section>
    </main>
</body>
</html>