document.addEventListener('DOMContentLoaded', function() {
    eventListeners();

    darkMode();
} );

function darkMode() {

    // Leer las preferencias del usuario para el darkMode
    const prefiereDarkMode = window.matchMedia( '(prefers-color-scheme: dark)' );
    // console.log( 'prefiere dark mode' );
    if ( prefiereDarkMode.matches ) {
        document.body.classList.add( 'dark-mode' );
    }
    else {
        document.body.classList.remove( 'dark-mode' );
    }

    //Observar cambios de la configuracion del sistema para 
    //Cambiar el tema del sitio web
    prefiereDarkMode.addEventListener( 'change', function() {
        if ( prefiereDarkMode.matches ) {
            document.body.classList.add( 'dark-mode' );
        }
        else {
            document.body.classList.remove( 'dark-mode' );
        }
    } );

    const botonDarkMode = document.querySelector( '.dark-mode-boton' );
    botonDarkMode.addEventListener( 'click', function() {
        document.body.classList.toggle( 'dark-mode' );
    } );
}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener( 'click', navegacionResponsive );

    // Muestra campos condicionales
    const metodoContacto = document.querySelectorAll( 'input[name="contacto[contacto]"]' );
    metodoContacto.forEach ( input => input.addEventListener( 'click' , mostrarMetodosContacto ) );
}

function navegacionResponsive() {
    const navegacion = document.querySelector( '.navegacion' );

    navegacion.classList.toggle( 'mostrar' );
}

function mostrarMetodosContacto( e ) {

    const contactoDiv = document.querySelector ( '#contacto' );
    
    if ( e.target.value === 'telefono')
        
        contactoDiv.innerHTML = `
            <label for="telefono">Numero de Telefono</label>
            <input type="tel" id="telefono" placeholder="Tu Telefono" name="contacto[telefono]">

            <p>Elija la fecha y hora para ser contactado.</p>
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="contacto[fecha]">

            <label for="hora">Hora</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;
    else
        contactoDiv.innerHTML = `
            <label for="email">E-Mail</label>
            <input type="emai" id="email" placeholder="Tu Email" name="contacto[email]">
        `;
}