<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Recuperar tu password</p>

    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>


    <?php if ($token_valido) : ?>
        <form method="POST" class="formulario">
            <div class="formulario__campo">
                <input name="password" type="password" class="formulario__input" id="password">
                <label class="formulario__label" for="password">Nuevo password</label>
            </div>
            <input type="submit" class="formulario__submit" value="Cambiar">
        </form>
    <?php endif; ?>



</main>