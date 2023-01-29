<h2 class="agenda__heading"><?php echo $titulo; ?></h2>

<p class="agenda__descripcion">Elige hasta 5 eventos para asisteir de forma presencial.</p>

<div class="eventos-registro">
    <main class="eventos-registro__listado">
        <h3 class="eventos-registro__heading--conferencias">&lt;Workshops/></h3>
        <p class="eventos-registro__fecha">Viernes 5 de Octubre</p>
        <div class="eventos-registro__grid">
            <?php foreach ($eventos['workshops_viernes'] as $evento) : ?>
                <?php include __DIR__ . '../evento.php' ?>
            <?php endforeach; ?>
        </div>
    </main>
    <aside class="registro">
                <h2 class="registro__heading">Tu Registro</h2>
    </aside>
</div>