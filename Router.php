<?php 

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    // * Funcion que reacciona a todas las peticiones GET

    public function get( $urlActual, $funcion ) {
        $this->rutasGET[ $urlActual ] = $funcion;
    }

    // * Funcion que reacciona a todas las peticiones POST

    public function post( $urlActual, $funcion ) {
        $this->rutasPOST[ $urlActual ] = $funcion;
    }
       
    public function comprobarRutas() {

        session_start();
        $auth = $_SESSION['login'] ?? null;

        //Arreglo de rutas protegidas
        $rutasProtegidas = [
            '/admin',
            '/propiedades/crear',
            '/propiedades/actualizar',
            '/propiedades/eliminar',
            'vendedores/crear',
            'vendedores/actualizar',
            'vendedores/eliminar',
        ];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if ( $metodo === 'GET' ) {
            $fn = $this->rutasGET[ $urlActual ] ?? null;
        } 
        else {
            $fn = $this->rutasPOST[ $urlActual ] ?? null;
        }

        //Proteger las rutas
        if ( in_array( $urlActual , $rutasProtegidas ) && !$auth ) {

            header( 'Location: /bienesraicesMVC/public/index.php' );
        }


        if ( $fn ) {
            call_user_func( $fn , $this );
        }
        else {
            echo "Pagina NO encontrada";
        }
    }

    //Muestra una vista
    public function render( $view , $datos = [] ) {

        foreach ( $datos as $key => $value ) {
            $$key = $value;
        }

        //Iniciar un almacenamiento en memoria de la vista durante un momento
        ob_start();

        include __DIR__ . "/views/$view.html.php";

        //Limpiar la memoria y limpiar la master page
        $contenido = ob_get_clean();

        include __DIR__ . "/views/layout.html.php";
    }

}