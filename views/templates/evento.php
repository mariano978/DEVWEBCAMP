<div class="evento swiper-slide">
    <p class="evento__hora"><?php echo $evento->hora->hora; ?></p>

    <div class="evento__informacion">
        <h4 class="evento__nombre"><?php echo $evento->nombre ?></h4>

        <div>
            <p class="evento__descripcion"><?php echo $evento->descripcion ?></p>
        </div>

        <div class="evento__autor-info">
            <picture>
                <source srcset="build/img/speakers/<?php echo $evento->ponente->imagen; ?>.webp" type="image/webp">
                <source srcset="build/img/speakers/<?php echo $evento->ponente->imagen; ?>.png" type="image/png">
                <img class="evento__imagen-autor" loading="lazy" width="200" height="300" src="build/img/speakers/<?php echo $evento->ponente->imagen; ?>.png" alt="ImagenPonente">
            </picture>

            <p class="evento__autor-nombre">
                <?php echo $evento->ponente->nombre; ?>
            </p>
        </div>
    </div>
</div>