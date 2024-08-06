
<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo Propiedad" value="<?php echo s($propiedad->titulo); ?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" min="0" value="<?php echo s($propiedad->precio); ?>">
    
    <label for="estado">Estado:</label>
    <select name="propiedad[estado]" id="estado" class="estado">
        <option value="default">Selecciona un Estado</option>
    </select>

    <label for="municipio">Municipio: </label>
    <select name="propiedad[municipio]" id="municipio" class="municipio">
        <option value="default">Selecciona un Municipio</option>
    </select>

    <label for="colonia">Colonia: </label>
    <input type="text" name="propiedad[colonia]" id="colonia" placeholder="Colonia Propiedad">
    
    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">

    <?php if($propiedad->imagen) { ?>
        <img src="/imagenes/<?php echo $propiedad->imagen ?>" alt="imagen de la propiedad" class="imagen-small">
    <?php } ?>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="propiedad[descripcion]"><?php echo s($propiedad->descripcion); ?></textarea>

</fieldset>

<fieldset>
    <legend>Información Propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->habitaciones); ?>">

    <label for="wc">Baños:</label>
    <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->wc); ?>">

    <label for="estacionamiento">Estacionamiento:</label>
    <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->estacionamiento); ?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>

    <label for="vendedor">Vendedor</label>
    <select name="propiedad[vendedorid]" id="vendedor">
        <option selected value="">-- Seleccione --</option>
        <?php foreach($vendedores as $vendedor) { ?>
            <option 
            <?php echo $propiedad->vendedorid === $vendedor->id ? 'selected' : '' ?> value="<?php echo s($vendedor->id); ?>"><?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?></option>
        <?php } ?>
    </select>
</fieldset>