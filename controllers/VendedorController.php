<?php

namespace Controllers;

use Model\Vendedor;
use MVC\Router;

class VendedorController {

    public static function crear( Router $router ) {
        
        $vendedor = new Vendedor();
        $errores = Vendedor::getErrores();

        if ( $_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $vendedor = new Vendedor( $_POST['vendedor'] );
            $errores = $vendedor->validar();

            if ( empty( $errores ) ) {
                $vendedor->guardar();
            }
        }

        $router->render( 'vendedores/crear' , [
            'vendedor' => $vendedor,
            'errores' => $errores
        ] );

    }
}