<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Informacion Personal</legend>
    <div class="formulario__campo">
        <input type="text" class="formulario__input" id="nombre" name="nombre" value="<?php echo $ponente->nombre ?? ''; ?>">
        <label for="nombre" class="formulario__label">Nombre del ponente</label>
    </div>

    <div class="formulario__campo">
        <input type="text" class="formulario__input" id="apellido" name="apellido" value="<?php echo $ponente->apellido ?? ''; ?>">
        <label for="apellido" class="formulario__label">Apellido del ponente</label>
    </div>

    <div class="formulario__campo">
        <input type="text" class="formulario__input" id="ciudad" name="ciudad" value="<?php echo $ponente->ciudad ?? ''; ?>">
        <label for="ciudad" class="formulario__label">Ciudad</label>
    </div>


    <div class="formulario__campo">
        <input type="text" class="formulario__input" id="pais" name="pais" value="<?php echo $ponente->pais ?? ''; ?>">
        <label for="pais" class="formulario__label">País</label>
    </div>


    <div class="formulario__campo--file">
        <p class="formulario__texto-file">Agregar archivo</p>
        <input type="file" class="formulario__input formulario__input--file" id="imagen" name="imagen" enctype="multipart/form-data" accept="image/*">
    </div>



    <div class="formulario__imagen--div">
        <?php if ($ponente->imagen) : ?>
            <picture class="formulario__picture">
                <source srcset="<?php echo $_ENV['HOST'] . "/build/img/speakers/" . $ponente->imagen . '.webp' ?>" type="image/webp">
                <source srcset="<?php echo $_ENV['HOST'] . "/build/img/speakers/" . $ponente->imagen . '.png' ?>" type="image/png">
                <img src="<?php echo $_ENV['HOST'] . "/build/img/speakers/" . $ponente->imagen . '.png' ?>" alt="ImagenPonente">
            </picture>
        <?php endif; ?>
    </div>

</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Informacion Extra</legend>
    <div class="formulario__campo">
        <label for="tag_input" class="formulario__label--normal">Area de experiencia (separada por coma)</label>
        <input type="text" class="formulario__input" id="tag_input" name="tag_input" placeholder="Ej. Node.js, PHP, CSS, Laravel, UX/UI">
        <div id="tags" class="formulario__listado"></div>
        <input type="hidden" name="tags" value="<?php echo $ponente->tags ?? ''; ?>">
    </div>
</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Redes Sociales</legend>
    <div class="formulario__campo">
        <div class="formulario__contenedo-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-facebook"></i>
            </div>
            <input type="text" class="formulario__input--sociales" name="redes[facebook]" placeholder="Facebook" value="<?php echo $redes->facebook ?? ""; ?>">

        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedo-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-twitter"></i>
            </div>
            <input type="text" class="formulario__input--sociales" name="redes[twitter]" placeholder="Twitter" value="<?php echo $redes->twitter ?? ""; ?>">

        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedo-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-youtube"></i>
            </div>
            <input type="text" class="formulario__input--sociales" name="redes[youtube]" placeholder="YouTube" value="<?php echo $redes->youtube ?? ""; ?>">

        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedo-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-instagram"></i>
            </div>
            <input type="text" class="formulario__input--sociales" name="redes[instagram]" placeholder="Instagram" value="<?php echo $redes->instagram ?? ""; ?>">

        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedo-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-tiktok"></i>
            </div>
            <input type="text" class="formulario__input--sociales" name="redes[tiktok]" placeholder="Tiktok" value="<?php echo $redes->tiktok ?? ""; ?>">

        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedo-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-github"></i>
            </div>
            <input type="text" class="formulario__input--sociales" name="redes[github]" placeholder="Github" value="<?php echo $redes->github ?? ""; ?>">

        </div>
    </div>
</fieldset>