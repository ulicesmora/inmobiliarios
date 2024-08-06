<main class="contenedor seccion importacion">
    <h1>Agregar Propiedades desde un Excel</h1>

    <form class="formulario formulario-importar" action="/propiedades/importar" method="POST">
        <fieldset>
            <legend>Seleccionar Archivo</legend>
    
            <label for="excelFile">Seleccione un archivo de Excel:</label>
            <input type="file" id="excelFile" accept=".xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" name="archivo[excel]">
        </fieldset>
    </form>
    <table class="tabla-importar">
        <tr>
            <th>Título</th>
            <th>Precio</th>
            <th>Estado</th>
            <th>Municipio</th>
            <th>Colonia</th>
            <th>Descripción</th>
            <th>Habitaciones</th>
            <th>Baños</th>
            <th>Estacionamiento</th>
        </tr>
    </table>
    <div id="output"></div>
    <input type="submit" value="Extraer" class="boton-verde">
</main>