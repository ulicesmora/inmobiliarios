<main class="contenedor seccion">
        <h1>Crear</h1>

        <section class="agregar-grupo">
        <a href="/propiedades/importar" class="boton-verde boton-excel">
                Importar de un Excel
            <!-- <img class="icono-excel" src="/build/img/excel-icon.svg" alt="icono de excel"> -->
        </a>
        </section>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>

            
        <?php endforeach; ?>
        <a href="/admin" class="boton boton-verde">Volver</a>
            
        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include __DIR__ . '/formulario.php'; ?>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
</main>