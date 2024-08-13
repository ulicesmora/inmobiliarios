<div class="contenedor-anuncios">
<?php foreach($propiedades as $propiedad) { ?>  
<div class="anuncio">

    <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="anuncio">

    <div class="contenido-anuncio">
        <h3><?php echo $propiedad->titulo; ?></h3>
        <p><?php echo $propiedad->descripcion; ?></p>
        <p class="precio"><?php echo $propiedad->precio; ?></p>
        <p class="propiedad-estado"><strong>Estado: </strong><?php echo $propiedad->estado; ?></p>
        <p><strong>Municipio: </strong><?php echo $propiedad->municipio; ?></p>
        <p><strong>Colonia: </strong><?php echo $propiedad->colonia; ?></p>
        <?php foreach($tipos as $tipo) { ?>
            <p><?php echo $propiedad->tipoid === $tipo->tipo_id ? "<strong>Tipo: </strong>" . s($tipo->tipo_inmueble) :  ''; ?></p>
        <?php } ?>
        <?php foreach($status as $statu) { ?>
            <p><?php echo $propiedad->statusid === $statu->status_id ? "<strong>Estatus: </strong>" . s($statu->status) :  ''; ?></p>
        <?php } ?>
        

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

        <a href="/propiedad?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">
            Ver Propiedad
        </a>
    </div><!-- contenido-anuncio -->
</div><!-- anuncio -->
<?php } ?>
</div><!-- contenedor-anuncios -->
