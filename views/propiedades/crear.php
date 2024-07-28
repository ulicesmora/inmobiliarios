<main class="contenedor seccion">
        <h1>Crear</h1>

        <section class="agregar-grupo">
        <a href="/construccion" class="boton-verde boton-excel">
            <p>
                Importar de un Excel
            </p>
            <img class="logo icono-excel" src="/build/img/excel-icon.svg" alt="icono de excel">
        </a>
        </section>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>

            <a href="/admin" class="boton boton-verde">Volver</a>
            
        <?php endforeach; ?>
        
        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include __DIR__ . '/formulario.php'; ?>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
</main>