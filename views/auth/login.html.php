<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>
    <?php foreach ( $errores as $error ) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>   
    <form method="POST" class="formulario">
        <fieldset>
            <legend>Email y Password</legend>
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Escribe tu email" >

            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </fieldset>
        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main> 