<main class="contenedor">
    <h1>Administrador de Bienes Raíces</h1>
    <?php 
        if ( $resultado ) {

            $mensaje = mostrarMensajes( intval( $resultado ) );

            if ( $mensaje ) { ?>
                <p class="alerta exito"> <?php echo s( $mensaje ) ?> </p>
            <?php }  
        }        
    ?>
    <a href="propiedades/crear" class="boton boton-verde"> Nueva Propiedad </a>
    <a href="vendedores/crear.html.php" class="boton boton-amarillo"> Nuevo Vendedor </a>


    <h2>Propiedades</h2>
    
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <!-- Mostrar los resultados -->
        <tbody>
            <?php foreach( $propiedades as $propiedad ) :  ?>
            <tr>
                <td> <?php echo $propiedad->id_propiedad ?> </td>
                <td> <?php echo $propiedad->titulo ?> </td>
                <td> <img src="../imagenes/<?php echo $propiedad->imagen ?>" class="imagen-tabla"> </td>
                <td> $ <?php echo $propiedad->precio ?> </td>
                <td>
                    <form method="POST" class="w-100">
                        <input type="hidden" name="id" value="<?php echo $propiedad->id_propiedad; ?>">
                        <input type="hidden" name="tipo" value = "propiedad">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a 
                        href="propiedades/actualizar.html.php?id=<?php echo $propiedad->id_propiedad; ?>"
                        class="boton-amarillo-block" >                            
                        Actualizar
                    </a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</main>