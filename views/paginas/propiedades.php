<main class="contenedor seccion">
    <h2>Casas y Departamentos en Venta</h2>
    <section class="buscador">
        <input class="entrada-buscador" type="search" name="buscador" id="buscador" placeholder="Buscar Propiedad">
        <!-- <img class="icono-buscar" src="/build/img/search.svg" alt="Icono Buscar"> -->
    </section>

    <section class="filtros">
        <form class="menu-filtros">
            <label for="estado">Estado: </label>
            <select name="estado" id="estado" class="estado">
                <option value="">Selecciona un Estado</option>
            </select>
        </form>
        <form class="menu-filtros">
            <label for="municipio">Municipio: </label>
            <select name="municipio" id="municipio" class="municipio">
                <option value="">Selecciona un Municipio</option>
            </select>
        </form>
        <!-- <form class="menu-filtros">
            <label for="colonia">Colonia: </label>
            <select name="colonia" id="colonia">
                <option value="">Selecciona una Colonia</option>
                <option value="muni1">Colonia 1</option>
                <option value="muni2">Colonia 2</option>
            </select> -->
        </form>
    </section>

    <h2 class="sin-resultados filter filter-active">No se encontraron coincidencias</h2>

    <?php include 'listado.php'; ?>

</main>