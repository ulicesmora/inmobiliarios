<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad->titulo; ?></h1>

    <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen de la propiedad">

    <div class="resumen-propiedad">
        <p class="precio"><?php echo $propiedad->precio; ?></p>

        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad->wc; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $propiedad->estacionamiento; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                <p><?php echo $propiedad->habitaciones; ?></p>
            </li>
        </ul>

        <p class="propiedad-estado"><strong>Estado: </strong><?php echo $propiedad->estado; ?></p>
        <p><strong>Municipio: </strong><?php echo $propiedad->municipio; ?></p>
        <p><strong>Colonia: </strong><?php echo $propiedad->colonia; ?></p>
        <?php foreach($tipos as $tipo) { ?>
            <p><?php echo $propiedad->tipoid === $tipo->tipo_id ? "<strong>Tipo: </strong>" . s($tipo->tipo_inmueble) :  ''; ?></p>
        <?php } ?>
        <?php foreach($status as $statu) { ?>
            <p><?php echo $propiedad->statusid === $statu->status_id ? "<strong>Estatus: </strong>" . s($statu->status) :  ''; ?></p>
        <?php } ?>

        <p> <?php echo $propiedad->descripcion; ?> </p>

        <button class="boton boton-verde"><a href="/contacto">Cotizar</a></button>
</main>