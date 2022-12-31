<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    <?php if ($usuario) : ?>
        <p class="auth__texto">Bienvenido <?php echo $usuario->nombre; ?></p>
        <div class="acciones">
            <a href="/login" class="acciones__enlace">Ya puedes inicia sesión, click aquí</a>
        </div>
    <?php endif; ?>
</main>