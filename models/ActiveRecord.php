<?php

namespace Model;

class ActiveRecord {
    
    protected static $db;
    protected static $columnasDb = [];
    protected static $tabla = '';

    //* Errores
    
    protected static $errores = [];
    
    //! Conexion a la base de datos

    public static function setDb( $database ) {
        self::$db = $database; 
    }

    //! Validacion

    public static function getErrores() {
        return static::$errores;
    }

    public function validar() {
        static::$errores = [];
        return static::$errores;
    }

     //* Guardar registro

     public function guardar() {
        if( !is_null( $this->id ) ) {
            //Actualizando el registro
            $this->actualizar();

        }
        else {
            //Creando el registro
            $this->crear();
        }
    }

    //* Lista todos los registros

    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL( $query );

        return $resultado;
    }

    //* Obtiene determinados numeros de registros
    public static function get( $cantidad ) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        $resultado = self::consultarSQL( $query );

        return $resultado;
    }

    //* Busca un registro por su ID

    public static function find( $id ) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";
        $resultado = self::consultarSQL( $query );
        return array_shift( $resultado ); 
    }

    // * Crear un nuevo registro

    public function crear() {
        //* Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $nombresColumnas = 

        //* Insertar en la base de datos
        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join( ', ' , array_keys( $atributos ) ); // Recorriendo cada key del array atributos y crear un string con todos los nombres de las columnas del query
        $query .= " ) VALUES ( ' ";
        $query .= join( "', '",  array_values( $atributos ) ); // Recorriendo cada value del array atributos y crear un string con todos los values del array
        $query .= " ') ";
        
        $resultado = self::$db->query( $query );

        
        if( $resultado ) {
            //* Redireccionar al usuario a la pagina de admin
            header('Location: ../admin?resultado=1');
        }
    }

    public function actualizar() {
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        $valores = [];

        foreach( $atributos as $key => $value ) {
            $valores[] = "$key = '$value'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', '  , $valores );
        $query .= " WHERE id = '" . self::$db->escape_string( $this->id ) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query( $query );

        if( $resultado ) {
            //* Redireccionar al usuario a la pagina de admin
            header('Location: ../admin?resultado=2');
        }
    }

    public function eliminar() {
        //* Eliminar la propiedad
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string( $this->id ) . " LIMIT 1";
        $resultado = self::$db->query( $query );
        
        if( $resultado ) {
            $this->borrarImagen();
            header('Location: ../admin?resultado=3' ); // $_SERVER['PHP_SELF'] -> para obtener la url actual        
        }
    }

    public static function consultarSQL( $query ) {
        //Consultar la base de datos
        $resultado = self::$db->query( $query );


        //Iterar los resultados
        $array = [];
        while( $registro = $resultado->fetch_assoc() ) {
            $array[] = static::crearObjeto( $registro );

        }
        //Liberar la memoria
        $resultado->free();
      
        // Retornar los resultados
        return $array;
    }

    protected static function crearObjeto( $registro ) {
        $objeto = new static;
        
        foreach( $registro as $key => $value ) {
            if( property_exists( $objeto, $key ) ) {
                $objeto->$key = $value; 
            }
        }

        return $objeto;
    }

    public function atributos() {
        $atributos = [];
        foreach( static::$columnasDb as $columna ) {
            if( $columna === 'id' ) continue;
            $atributos[ $columna ] = $this->$columna; 
        }
        return $atributos;
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach( $atributos as $key => $value ) {
            $sanitizado[ $key ] = self::$db->escape_string( $value ); //Asignando el valor sanitizado al array "sanitizado"
        }

        return $sanitizado;
    }

    // * Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar( $args = [] ) {
        foreach( $args as $key => $value ) {
            if ( $key === 'id' ) continue;
            if( property_exists( $this , $key ) && !is_null( $value ) ) {
                $this->$key = $value;
            }
        }
    }

    //* Subida de archivos
    public function setImagen( $imagen ) {

        // Elimina la imagen previa
        if( !is_null( $this->id ) ) {
            $this->borrarImagen();
        }
        // Asignar al atributo imagen el nombre de la imagen
        if( $imagen ) {
            $this->imagen = $imagen;
        }
    }

    //! Eliminar imagen
    public function borrarImagen() {
        // Elimina la imagen previa
        $existeArchivo = file_exists( CARPETA_IMAGENES . $this->imagen );
        if( $existeArchivo ) {
            unlink( CARPETA_IMAGENES . $this->imagen );
        }
    }
}
