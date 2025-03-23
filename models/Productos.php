<?php

require_once '../config/conexion.php'; // ✅ Se incluye correctamente el archivo de conexión
require_once '../config/funciones.php'; // ✅ Se incluye correctamente el archivo de conexión

class Productos
{

    private $conexion;
    private $registro; // ✅ Se declara la instancia para el objeto RegistroActividad 

    public function __construct()
    {
        $this->conexion = (new Conexion())->getConexion(); // ✅ Ahora obtiene correctamente la conexión
        $this->registro = new RegistroActividad(); // ✅ Se asigna el objeto RegistroActividad a la propiedad de la clase para los logs.
    }

    public function get_producto()
    {
        try {
            $sql = "SELECT * FROM  c_productos";  //Es una vista que contiene el nombre de los paises
            $stmt = $this->conexion->prepare($sql); // Se accede a la conexión correcta
            $stmt->execute();

            return $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los usuarios
        } catch (PDOException $e) {
            // Esto para desarrollo
            //die("Error al mostrar los productos: " . $e->getMessage());

            $this->registro->registrarActividad(
                'admin',
                'Productos',
                'get_productox',
                "Error al listar los productos: " . $e->getMessage(),
                "error"
            );


            //En producción, se recomienda registrar el error en un archivo de logs y devolver false
            /*error_log("Error al obtener usuarios: " . $e->getMessage()); // Registrar error
            return false; // No detener el script, manejar el error en la llamada*/
            // El error se almacena en los logs de PHP o Apache (/var/log/apache2/error.log).
        }
    }

    public function get_productoxid($prod_id)
    {
        try {
            $sql = "SELECT * FROM  tm_producto where prod_id=?";
            $stmt = $this->conexion->prepare($sql); // Se accede a la conexión correcta
            $stmt->bindValue(1, $prod_id, PDO::PARAM_INT);
            $stmt->execute();
            return $resultado = $stmt->fetch(PDO::FETCH_ASSOC); // Solo devuelve un registro;
        } catch (PDOException $e) {
            // Esto para desarrollo
            //die("Error al mostrar el producto {$prod_id}:" . $e->getMessage());

            // Esto para producción
            $this->registro->registrarActividad(
                'admin',
                'Productos',
                'get_productoxid',
                "Error al mostrar el producto {$prod_id}: " . $e->getMessage(),
                "error"
            );

            return false;
            //En producción, se recomienda registrar el error en un archivo de logs y devolver false
            /*error_log("Error al obtener usuarios: " . $e->getMessage()); // Registrar error
            return false; // No detener el script, manejar el error en la llamada*/
            // El error se almacena en los logs de PHP o Apache (/var/log/apache2/error.log).
        }
    }

    public function delete_productoxid($prod_id)
    {
        try {
            $sql = "UPDATE tm_producto set est=0, fech_elim = now() where prod_id=?";
            $stmt = $this->conexion->prepare($sql); // Se accede a la conexión correcta
            $stmt->bindValue(1, $prod_id, PDO::PARAM_INT);
            $stmt->execute();


            // Para los logs
            $this->registro->registrarActividad(
                'admin',
                'Productos',
                'Desactivar',
                "Se desactivó el producto con ID: $prod_id",
                'info'
            );

            return $stmt->rowCount() > 0; // Retorna true si se eliminó al menos un usuario, false si no existía el ID.
        } catch (PDOException $e) {
            // Esto para desarrollo
            //die("Error al mostrar el producto {$prod_id}:" . $e->getMessage());

            // Esto para producción
            $this->registro->registrarActividad(
                'admin',
                'Productos',
                'delete_productoxid',
                "Error al desactivar el producto {$prod_id}: " . $e->getMessage(),
                'error'
            );


            return false;

            //En producción, se recomienda registrar el error en un archivo de logs y devolver false
            /*error_log("Error al obtener usuarios: " . $e->getMessage()); // Registrar error
            return false; // No detener el script, manejar el error en la llamada*/
            // El error se almacena en los logs de PHP o Apache (/var/log/apache2/error.log).
        }
    }

    public function activar_productoxid($prod_id)
    {
        try {
            $sql = "UPDATE tm_producto set est=1, fech_elim = null where prod_id=?";
            $stmt = $this->conexion->prepare($sql); // Se accede a la conexión correcta
            $stmt->bindValue(1, $prod_id, PDO::PARAM_INT);
            $stmt->execute();

            // Para generar los logs
            $this->registro->registrarActividad(
                'admin',
                'Productos',
                'Activar',
                "Se activo el producto con ID: $prod_id",
                'info'
            );


            // return $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve el resultado de un solo usuario (fetch)
            return $stmt->rowCount() > 0; // Retorna true si se eliminó al menos un usuario, false si no existía el ID.
        } catch (PDOException $e) {
            // Esto para desarrollo
            //die("Error al activar el producto {$prod_id}:" . $e->getMessage());

            // Esto para producción
            $this->registro->registrarActividad(
                'admin',
                'Productos',
                'activar_productoxid',
                "Error al activar el producto {$prod_id}: " . $e->getMessage(),
                "error"
            );

            return false;

            //En producción, se recomienda registrar el error en un archivo de logs y devolver false
            /*error_log("Error al obtener usuarios: " . $e->getMessage()); // Registrar error
            return false; // No detener el script, manejar el error en la llamada*/
            // El error se almacena en los logs de PHP o Apache (/var/log/apache2/error.log).
        }
    }

    public function insert_producto($prod_nom, $oferta, $estadoProducto, $idPaises)
    {
        try {
            $sql = "INSERT INTO tm_producto (prod_nom, est, fech_crea, oferta, estadoProducto, paisesId ) VALUES (?, 1, now(), ?, ?, ?)";
            $stmt = $this->conexion->prepare($sql); // Se accede a la conexión correcta
            $stmt->bindValue(1, $prod_nom, PDO::PARAM_STR); // Se enlaza el valor del nombre
            $stmt->bindValue(2, $oferta, PDO::PARAM_INT); // Se enlaza el valor del nombre
            $stmt->bindValue(3, $estadoProducto, PDO::PARAM_INT); // Se enlaza el valor del nombre
            $stmt->bindValue(4, $idPaises, PDO::PARAM_INT); // Se enlaza el valor del nombre
            $stmt->execute();
            $idInsert = $this->conexion->lastInsertId(); // Se obtiene el ID del ultimo insertado



            // Para generar los logs
            $this->registro->registrarActividad(
                'admin',
                'Productos',
                'Insertar',
                "Se inserto el producto con ID: $idInsert",
                'info'
            );

            //return true; // Devuelve true si la inserción fue exitosa
            return $idInsert; // Devuelve el ID del usuario insertado
        } catch (PDOException $e) {
            // Esto para desarrollo
            //die("Error al insertar el producto: " . $e->getMessage());

            // Esto para producción
            $this->registro->registrarActividad(
                'admin',
                'Productos',
                'insert_producto',
                "Error al insertar el producto: " . $e->getMessage(),
                'error'
            );

            return false;
        }
    }

    public function insert_img_producto($prod_id, $prod_img, $uploadDir)
    {
        try {
            $sql = "INSERT INTO tm_img_producto (prod_id, prod_img) VALUES (?, ?)";
            $stmt = $this->conexion->prepare($sql); // Se accede a la conexión correcta
            $stmt->bindValue(1, $prod_id, PDO::PARAM_INT); // Se enlaza el valor del nombre
            $stmt->bindValue(2, $prod_img, PDO::PARAM_STR); // Se enlaza el valor del nombre
            $stmt->execute();
            $idInsert_img = $this->conexion->lastInsertId(); // Se obtiene el ID del ultimo insertado

            return $idInsert_img; // Devuelve el ID de la imagen insertada

            // Para generar los logs
            $this->registro->registrarActividad(
                'admin',
                'Productos.php',
                'Insertar imagen',
                "Se inserto la imagen con ID: $idInsert_img",
                'info'
            );
        } catch (PDOException $e) {
            // Esto para desarrollo
            //die("Error al insertar el producto: " . $e->getMessage());

            // Esto para producción
            $this->registro->registrarActividad(
                'admin',
                'Productos',
                'insert_imagen_producto',
                "Error al insertar la imagen del producto: " . $e->getMessage(),
                'error'
            );
            return false;
        }
    }

    public function update_producto($prod_id, $prod_nom, $oferta, $estadoProducto, $idPaises)
    {
        try {
            $sql = "UPDATE tm_producto SET prod_nom = ?, oferta = ?, estadoProducto = ?, paisesId = ?, fech_modi = now() WHERE prod_id = ?";
            $stmt = $this->conexion->prepare($sql); // Se accede a la conexión correcta
            $stmt->bindValue(1, $prod_nom, PDO::PARAM_STR);
            $stmt->bindValue(2, $oferta, PDO::PARAM_INT);
            $stmt->bindValue(3, $estadoProducto, PDO::PARAM_INT);
            $stmt->bindValue(4, $idPaises, PDO::PARAM_INT);
            $stmt->bindValue(5, $prod_id, PDO::PARAM_INT);
            $stmt->execute();

            // Para generar los logs
            $this->registro->registrarActividad(
                'admin',
                'Productos',
                'Actualizar',
                "Se actualizó el producto con ID: $prod_id",
                'info'
            );



            return true; // Devuelve true si el update fue exitoso

        } catch (PDOException $e) {
            // Esto para desarrollo
            //die("Error al hacer update al producto: " . $e->getMessage());

            // Esto para producción
            $this->registro->registrarActividad(
                'admin',
                'Productos',
                'update_producto',
                "Error al actualizar el producto:" . $e->getMessage(),
                'error'
            );
        }
    }
}
