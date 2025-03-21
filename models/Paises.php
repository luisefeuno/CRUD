<?php

require_once '../config/conexion.php'; // ✅ Se incluye correctamente el archivo de conexión
class Paises
{

    private $conexion;

    public function __construct()
    {
        $this->conexion = (new Conexion())->getConexion(); // ✅ Ahora obtiene correctamente la conexión
    }

    public function get_pais()
    {
        try {
            $sql = "SELECT * FROM paises";  //Es una vista que contiene el nombre de los paises
            $stmt = $this->conexion->prepare($sql); // Se accede a la conexión correcta
            $stmt->execute();
            return $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los usuarios
        } catch (PDOException $e) {
            // Esto para desarrollo
            die("Error al mostrar los paises: " . $e->getMessage());

            //En producción, se recomienda registrar el error en un archivo de logs y devolver false
            /*error_log("Error al obtener usuarios: " . $e->getMessage()); // Registrar error
            return false; // No detener el script, manejar el error en la llamada*/
            // El error se almacena en los logs de PHP o Apache (/var/log/apache2/error.log).
        }
    }

    public function get_paisxid($idpaises)
    {
        try {
            $idpaises = (int)$idpaises; // Se asegura que sea un entero
            $sql = "SELECT * FROM paises where idpaises=?";
            $stmt = $this->conexion->prepare($sql); // Se accede a la conexión correcta
            $stmt->bindValue(1, $idpaises, PDO::PARAM_INT);
            $stmt->execute();
            return $resultado = $stmt->fetch(PDO::FETCH_ASSOC); // Solo devuelve un registro;
        } catch (PDOException $e) {
            // Esto para desarrollo
            die("Error al mostrar el producto {$idpaises}:" . $e->getMessage());

            //En producción, se recomienda registrar el error en un archivo de logs y devolver false
            /*error_log("Error al obtener usuarios: " . $e->getMessage()); // Registrar error
            return false; // No detener el script, manejar el error en la llamada*/
            // El error se almacena en los logs de PHP o Apache (/var/log/apache2/error.log).
        }
    }

    public function delete_paisxid($idpaises)
    {
        try {
            $sql = "UPDATE paises set  est=0, fech_elim = now() where idpaises=?";
            $stmt = $this->conexion->prepare($sql); // Se accede a la conexión correcta
            $stmt->bindValue(1, $idpaises, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->rowCount() > 0; // Retorna true si se eliminó al menos un usuario, false si no existía el ID.
        } catch (PDOException $e) {
            // Esto para desarrollo
            die("Error al mostrar el pais {$idpaises}:" . $e->getMessage());
            return false;

            //En producción, se recomienda registrar el error en un archivo de logs y devolver false
            /*error_log("Error al obtener usuarios: " . $e->getMessage()); // Registrar error
            return false; // No detener el script, manejar el error en la llamada*/
            // El error se almacena en los logs de PHP o Apache (/var/log/apache2/error.log).
        }
    }

    public function activar_paisxid($idpaises)
    {
        try {
            $sql = "UPDATE paises set est=1, fech_elim = null where idpaises=?";
            $stmt = $this->conexion->prepare($sql); // Se accede a la conexión correcta
            $stmt->bindValue(1, $idpaises, PDO::PARAM_INT);
            $stmt->execute();
            // return $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve el resultado de un solo usuario (fetch)
            return $stmt->rowCount() > 0; // Retorna true si se eliminó al menos un usuario, false si no existía el ID.
        } catch (PDOException $e) {
            // Esto para desarrollo
            die("Error al activar el pais {$idpaises}:" . $e->getMessage());
            return false;

            //En producción, se recomienda registrar el error en un archivo de logs y devolver false
            /*error_log("Error al obtener usuarios: " . $e->getMessage()); // Registrar error
            return false; // No detener el script, manejar el error en la llamada*/
            // El error se almacena en los logs de PHP o Apache (/var/log/apache2/error.log).
        }
    }

    public function insert_pais($idpaises)
    {
        try {
            $sql = "INSERT INTO paises (idpaises, descrPaises, fech_crea, est) VALUES (0, ?, now(), 1)";
            $stmt = $this->conexion->prepare($sql); // Se accede a la conexión correcta
            $stmt->bindValue(1, $idpaises, PDO::PARAM_STR); // Se enlaza el valor del nombre
            $stmt->execute();
            $idInsert = $this->conexion->lastInsertId(); // Se obtiene el ID del ultimo insertado

            return true; // Devuelve true si la inserción fue exitosa
            //return $idInsert; // Devuelve el ID del usuario insertado
        } catch (PDOException $e) {
            die("Error al insertar el producto: " . $e->getMessage());
        }
    }

    public function update_pais($idpaises, $descrPaises)
    {
        try {
            $sql = "UPDATE paises SET descrPaises = ?, fech_modi = now() WHERE idpaises = ?";
            $stmt = $this->conexion->prepare($sql); // Se accede a la conexión correcta
            $stmt->bindValue(1, $descrPaises, PDO::PARAM_STR);
            $stmt->bindValue(2, $idpaises, PDO::PARAM_INT);
            $stmt->execute();

            return true; // Devuelve true si el update fue exitoso

        } catch (PDOException $e) {
            die("Error al hacer update al pais: " . $e->getMessage());
        }
    }
}
