<main class="contenedor contenido-centrado">
    <h1>Contacto</h1>

    <?php 
        if ( $mensaje ) { ?>
            <p class="alerta exito"> <?php $mensaje?></p>
    <?php } ?>

    <picture>
        <source srcset="/bienesraicesMVC/public/build/img/destacada3.webp" type="image/webp">
        <source srcset="/bienesraicesMVC/public/build/img/destacada3.jpg" type="image/jpg">
        <img src="/bienesraicesMVC/public/build/img/destacada3.jpg" alt="Imagen Contacto" loading="lazy">
    </picture>

    <h2>Llene el formulario de contacto</h2>
    <form action="contacto" class="formulario" method="POST">
        <fieldset>
            <legend>Información Personal</legend>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" placeholder="Tu Nombre" name="contacto[nombre]" >

            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" cols="30" rows="10" name="contacto[mensaje]" ></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>
            <label for="opciones">Vende O Compra</label>
            <select name="contacto[tipo]" id="opciones"  >
                <option value="" disabled selected>--Seleccionar--</option>
                <option value="Compra">Compra</option>
                <option value="Venta">Vender</option>
            </select>
            <label for="presupuesto">Precio o Presupuesto</label>
            <input type="number" id="presupuesto" name="contacto[precio]">
        </fieldset>

        <fieldset>
            <legend>Información de contacto</legend>
            <p>¿Cómo desea ser contactado?</p>
            <div class="forma-contacto">
                <label for="contactar-telefono">Telefono</label>
                <input type="radio" id="contactar-telefono" value="telefono" name="contacto[contacto]" >

                <label for="contactar-email">Email</label>
                <input type="radio" id="contactar-email" value="email" name="contacto[contacto]">
            </div>

            <div id="contacto"></div>

            
        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>
