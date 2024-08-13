<main class="contenedor seccion importacion">
    <h1>Agregar Propiedades desde un Excel</h1>

    <form class="formulario formulario-importar" action="/propiedades/importar">
        <fieldset>
            <legend>Seleccionar Archivo</legend>
    
            <label for="excelFile">Seleccione un archivo de Excel:</label>
            <input type="file" id="excelFile" accept=".xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" name="archivo[excel]">
        </fieldset>
    </form>
    <h5 class="estructura alerta error filter">El archivo no cumple la estructura necesaria</h5>
    <?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>
    <?php endforeach; ?>
    <form class="formulario" method="POST" enctype="multipart/form-data">
        <table class="tabla-importar">
            <tr>
                <th>Título</th>
                <input type="hidden" name="propiedad[titulo]" value="<?php echo s($propiedad->titulo); ?>">
                <th>Precio</th>
                <input type="hidden" name="propiedad[precio]" value="<?php echo s($propiedad->precio); ?>">
                <th>Estado</th>
                <th>Municipio</th>
                <th>Colonia</th>
                <input type="hidden" name="propiedad[colonia]" value="<?php echo s($propiedad->colonia); ?>">
                <th>Descripción</th>
                <th>Habitaciones</th>
                <input type="hidden"  name="propiedad[habitaciones]" value="<?php echo s($propiedad->habitaciones); ?>">
                <th>Baños</th>
                <input type="hidden" name="propiedad[wc]" value="<?php echo s($propiedad->wc); ?>">
                <th>Estacionamiento</th>
                <input type="hidden" name="propiedad[estacionamiento]" value="<?php echo s($propiedad->estacionamiento); ?>">
                <th>Tipo</th>
                <th>Estatus</th>
                <input type="hidden" name="propiedad[imagen]">
            </tr>
        </table>
        <input class="variable-total" type="hidden" name="total" value=""></input>`
        <input type="submit" value="Almacenar Propiedades" class="boton-verde">
    </form>
    <div id="output"></div>
</main>