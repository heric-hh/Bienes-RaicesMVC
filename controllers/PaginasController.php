<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {

    public static function index( Router $router ) {

        $propiedades = Propiedad::get( 3 );
        $inicio  = true;

        $router->render( 'paginas/index' , [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ] );
    }

    public static function nosotros( Router $router ) {

        $router->render( 'paginas/nosotros' , [ ] );

    }

    public static function propiedades( Router $router ) {

        $propiedades = Propiedad::all();
        
        $router->render( 'paginas/propiedades' , [
            'propiedades' => $propiedades
        ] );
    }

    public static function propiedad( Router $router ) {
        
        $id = validarORedireccionar( '/propiedad' );
        $propiedad = Propiedad::find( $id );

        $router->render( 'paginas/propiedad' , [
            'propiedad' => $propiedad
        ] );
    }

    public static function blog( Router $router ) {
        
        $router->render( 'paginas/blog' , [

        ] );
    }

    public static function entrada( Router $router ) {
        
        $router->render( 'paginas/entrada' , [
            
        ] );
    }

    public static function contacto( Router $router ) {

        $mensaje = null;
        
        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

            $respuestas = $_POST['contacto'];
            $mail = new PHPMailer();

            // Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '8a47a090364bbb';
            $mail->Password = '2047a2b7b61daa';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            //Configurar el contenido del email
            $mail->setFrom( 'admin@bienesraices.com' );
            $mail->addAddress( 'admin@bienesraices.com' , 'BienesRaices.com' );
            $mail->Subject = 'Tienes un nuevo mensaje';

            //Habilitar HTML
            $mail->isHTML( true );
            $mail->CharSet = 'UTF-8';

            //Definir contenido
            $contenido = '<html>';
            $contenido .= '<p> Tienes un nuevo mensaje </p>';
            $contenido .= '<p> Nombre : ' . $respuestas['nombre'] . '</p>';

            //Enviando de forma condicional algunos campos de email o telefono
            if ( $respuestas['contacto'] === 'telefono' ) {

                $contenido .= '<p> Eligio ser contactado por email</p>';
                $contenido .= '<p> Teléfono : ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p> Fecha Contacto : ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p> Hora Contacto : ' . $respuestas['hora'] . '</p>';


            }
            else {
                // Es email, entonces agregamos el campo email
                $contenido .= '<p> Eligio ser contactado por email</p>';
                $contenido .= '<p> Email : ' . $respuestas['email'] . '</p>';
                
            }

            $contenido .= '<p> Mensaje : ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p> Vende o Compra : ' . $respuestas['tipo'] . '</p>';
            $contenido .= '<p> Precio o Presupuesto : ' . $respuestas['precio'] . '</p>';
            $contenido .= '<p> Prefiere ser contactado por : ' . $respuestas['contacto'] . '</p>';
            $contenido .= '</html>';
            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es un texto alternativo sin HTML';

            //Envia el email
            if ( $mail->send() ) {
                $mensaje = "Mensaje Enviado Correctamente";
            }
            else {
                $mensaje =  "El mensaje no se pudo enviar";
            }

        }
        

        $router->render( 'paginas/contacto' , [
            'mensaje' => $mensaje
        ] );
    }
}