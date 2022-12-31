<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Recuperar tu acceso a DevWebCamp</p>

    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <form method="POST" class="formulario" action="/olvide">
        <div class="formulario__campo">
            <input name="email" type="email" class="formulario__input" id="email">
            <label class="formulario__label" for="email">Email</label>
        </div>
        <input type="submit" class="formulario__submit" value="Enviar Instrucciones">
    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes cuenta?, Inicia Sesión</a>
        <a href="/registro" class="acciones__enlace">¿Aún no tienes cuenta?, Crea Una</a>

    </div>
</main>