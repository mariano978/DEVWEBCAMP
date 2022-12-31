<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Informacion Evento</legend>
    <div class="formulario__campo">
        <input type="text" class="formulario__input" id="nombre" name="nombre" value="<?php echo $evento->nombre ?? ''; ?>">
        <label for="nombre" class="formulario__label">Nombre del evento</label>
    </div>

    <div class="formulario__campo">
        <textarea class="formulario__input formulario__input--textarea" id="descripcion" name="descripcion"><?php echo $evento->descripcion ?? ''; ?></textarea>
        <label for="descripcion" class="formulario__label">Descripcion</label>
    </div>


    <div class="formulario__campo">
        <label for="categoria" class="formulario__label--normal">Categoria o Tipo de evento</label>
        <select class="formulario__select" id="categoria" name="categoria_id">
            <option value="">-- Seleccionar --</option>
            <?php foreach ($categorias as $categoria) : ?>
                <option <?php echo ($evento->categoria_id === $categoria->id) ? 'selected = "selected"' : ''; ?> value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre; ?></option>
            <?php endforeach; ?>
        </select>
    </div>


    <div class="formulario__campo">
        <label for="dia" class="formulario__label--normal">Selecciona el Dia</label>
        <div class="formulario__radio" id="dia">
            <?php foreach ($dias as $dia) : ?>
                <div>
                    <label for="<?php echo strtolower($dia->nombre); ?>"><?php echo $dia->nombre; ?></label>
                    <input type="radio" id="<?php echo strtolower($dia->nombre); ?>" name="dia" value="<?php echo $dia->id; ?>" <?php echo ($evento->dia_id === $dia->id) ? 'checked' : ''; ?>>
                </div>
            <?php endforeach; ?>
        </div>

        <input type="hidden" name="dia_id" value="<?php echo $evento->dia_id ?? ''; ?>">
    </div>

    <div id="horas" class="formulario__campo">
        <label for="" class="formulario__label--normal">Seleccionar Hora</label>
        <ul id="horas" class="horas">
            <?php foreach ($horas as $hora) : ?>
                <li data-hora-id="<?php echo $hora->id; ?>" class="horas__hora horas__hora--deshabilitada"><?php echo $hora->hora; ?></li>
            <?php endforeach; ?>
        </ul>
        <input type="hidden" name="hora_id" value="<?php echo $evento->hora_id ?? ''; ?>">
    </div>

</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Informacion Extra</legend>

    <div class="formulario__campo">
        <label for="ponentes" class="formulario__label--normal">Ponente</label>
        <input type="text" class="formulario__input" id="ponentes" name="ponente_input" value="<?php echo $evento->ponente_input ?? ''; ?>" placeholder="Buscar Ponente">
        <ul class="listado-ponentes" id="listado-ponentes"></ul>
        <input type="hidden" value="<?php echo $evento->ponente_id ?? ''; ?>" name="ponente_id">
    </div>

    <div class="formulario__campo">
        <label for="disponibles" class="formulario__label--normal">Lugares disponibles</label>
        <input type="number" min="1" class="formulario__input" id="disponibles" name="disponibles" value="<?php echo $evento->disponibles; ?>" placeholder="Ej. 20">
    </div>
</fieldset>