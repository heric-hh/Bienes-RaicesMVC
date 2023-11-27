<div class="contenedor-anuncios">
    <?php 
        foreach ( $propiedades as $propiedad ) : 
    ?>
    <div class="anuncio">
        <img src="/bienesraicesMVC/public/imagenes/<?php echo $propiedad->imagen ?>" alt="Anuncio" loading="lazy">

        <div class="contenido-anuncio">
            <h3><?php echo $propiedad->titulo ?></h3>
            <p><?php echo $propiedad->descripcion ?></p>
            <p class="precio">$<?php echo $propiedad->precio ?></p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" src="/bienesraicesMVC/public/build/img/icono_wc.svg" alt="Icono WC" loading="lazy">
                    <p><?php echo $propiedad->wc ?></p>
                </li>

                <li>
                    <img class="icono" src="/bienesraicesMVC/public/build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento" loading="lazy">
                    <p><?php echo $propiedad->estacionamiento ?></p>
                </li>

                <li>
                    <img class="icono" src="/bienesraicesMVC/public/build/img/icono_dormitorio.svg" alt="Icono Habitaciones" loading="lazy">
                    <p><?php echo $propiedad->habitaciones ?></p>
                </li>
            </ul>

            <a href="/bienesraicesMVC/public/index.php/propiedad?id=<?php echo $propiedad->id ?>" class="boton-amarillo-block">
                Ver Propiedad
            </a>
        </div> <!-- Contenido Anuncio-->
    </div>  <!--Anuncio-->

    <?php endforeach; ?>
</div>