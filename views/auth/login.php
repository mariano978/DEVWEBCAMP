<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Inicia Sesión en DevWebCamp</p>

    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <form method="POST" class="formulario" action="/login">
        <div class="formulario__campo">
            <input name="email" type="email" class="formulario__input" id="email">
            <label class="formulario__label" for="email">Email</label>
        </div>
        <div class="formulario__campo">
            <input name="password" type="password" class="formulario__input" id="password">
            <label class="formulario__label" for="password">Password</label>
        </div>
        <input type="submit" class="formulario__submit" value="Iniciar Sesión">
    </form>

    <div class="acciones">
        <a href="/registro" class="acciones__enlace">¿Aún no tienes cuenta?, Crea Una</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu password?</a>
    </div>
</main>