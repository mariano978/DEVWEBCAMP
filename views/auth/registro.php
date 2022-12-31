<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Registrate en DevWebCamp</p>

    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <form method="POST" class="formulario" action="/registro">
        <div class="formulario__grid">
            <div class="formulario__campo">
                <input name="nombre" type="text" class="formulario__input" id="nombre" value="<?php echo $usuario->nombre; ?>">
                <label class="formulario__label" for="nombre">Tu nombre</label>
            </div>
            <div class="formulario__campo">
                <input name="apellido" type="text" class="formulario__input" id="apellido" value="<?php echo $usuario->apellido; ?>">
                <label class="formulario__label" for="apellido">Tu apellido</label>
            </div>
        </div>

        <div class="formulario__campo">
            <input name="email" type="email" class="formulario__input" id="email" value="<?php echo $usuario->email; ?>">
            <label class="formulario__label" for="email">Email</label>
        </div>
        <div class="formulario__grid">
            <div class="formulario__campo">
                <input name="password" type="password" class="formulario__input" id="password">
                <label class="formulario__label" for="password">Password</label>
            </div>
            <div class="formulario__campo">
                <input name="password2" type="password" class="formulario__input" id="password2">
                <label class="formulario__label" for="password2">Repite Password</label>
            </div>
        </div>


        <input type="submit" class="formulario__submit" value="Registrar">
    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes cuenta?, Inicia Sesión</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu password?</a>
    </div>
</main>