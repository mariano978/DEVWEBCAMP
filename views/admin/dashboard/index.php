<h1 class="dashboard__heading"><?php echo $titulo; ?></h1>

<div class="bloques">
    <div class="bloques__grid">
        <div class="bloque">
            <h3 class="bloque__heading">Ultimos Registros</h3>
            <?php foreach ($registros as $registro) : ?>
                <div class="bloque__contenido">
                    <p class="bloque__texto">
                        <?php echo $registro->usuario->nombre . " " . $registro->usuario->apellido; ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="bloque">
            <h3 class="bloque__heading">Ingresos</h3>
            <p class="bloque__texto bloque__texto--cantidad"> $ <?php echo $ingresos; ?> </p>
        </div>

        <div class="bloque">
            <h3 class="bloque__heading">Eventos menos disponibles</h3>
            <?php foreach ($eventosMenosDisp as $evento) : ?>
                <p class="bloque__texto bloque__texto--disponibles"><?php echo $evento->nombre . ' (' . $evento->disponibles . ')'; ?></p>
            <?php endforeach; ?>
        </div>

        <div class="bloque">
            <h3 class="bloque__heading">Eventos mas disponibles</h3>
            <?php foreach ($eventosMasDisp as $evento) : ?>
                <p class="bloque__texto bloque__texto--disponibles"><?php echo $evento->nombre . ' (' . $evento->disponibles . ')'; ?></p>
            <?php endforeach; ?>
        </div>
    </div>
</div>