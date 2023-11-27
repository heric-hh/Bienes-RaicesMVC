<main class="contenedor seccion contenido-centrado">
    <h1> <?php echo $propiedad->titulo ?> </h1>
    <picture>
        <!-- <source srcset="build/img/destacada.webp" type="image/webp">
        <source srcset="build/img/destacada.jpg" type="image/jpg"> -->
        <img src="/bienesraicesMVC/public/imagenes/<?php echo $propiedad->imagen ?>" alt="imagen de la propiedad" loading="lazy">
    </picture>
    <div class="resumen-propiedad">
        <div class="precio"> $<?php echo $propiedad->precio ?> </div>
        <ul class="iconos-caracteristicas">
            <li>
                <img src="/bienesraicesMVC/public/build/img/icono_wc.svg" alt="Icono WC" loading="lazy" class="icono-anuncio">
                <p> <?php echo $propiedad->wc ?> </p>
            </li>

            <li>
                <img src="/bienesraicesMVC/public/build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento" loading="lazy" class="icono-anuncio">
                <p> <?php echo $propiedad->estacionamiento ?> </p>
            </li>

            <li>
                <img src="/bienesraicesMVC/public/build/img/icono_dormitorio.svg" alt="Icono Habitaciones" loading="lazy" class="icono-anuncio">
                <p> <?php echo $propiedad->habitaciones ?> </p>
            </li>
        </ul>

        <p>
        <?php echo $propiedad->descripcion ?>
        </p>

    </div>
</main>