<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController {

    public static function index( Router $router ) {
        $propiedades = Propiedad::all();
        $resultado = $_GET['resultado'] ?? null;

        $router->render( 'propiedades/admin' , [
            'propiedades' => $propiedades,
            'resultado' => $resultado
        ]);
    }

    public static function crear( Router $router ) {

        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();

        $errores = Propiedad::getErrores();

        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

            $propiedad = new Propiedad( $_POST['propiedad'] );
            $nombreImagen = md5( uniqid( rand() , true ) ) . ".jpg";

            if( $_FILES['propiedad']['tmp_name']['imagen'] ) {

                $image = Image::make( $_FILES['propiedad']['tmp_name']['imagen'] )->fit( 800, 600 );
                $propiedad->setImagen( $nombreImagen );
            }
            
            $errores = $propiedad->validar();
        
            if( empty( $errores ) ) {
            
                if( !is_dir( CARPETA_IMAGENES ) ) {
                    mkdir( CARPETA_IMAGENES );
                }

                $image->save( CARPETA_IMAGENES . $nombreImagen );
                
                $propiedad->guardar();
            }   
        }

        $router->render( 'propiedades/crear' , [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar() {
        echo "actualizar";
    }
}