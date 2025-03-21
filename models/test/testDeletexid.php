<?php
// Fichero testupdate.php
// Este fichero se encarga de probar la inserción de un usuario en la base de datos 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'Productos.php';

$productos = new Productos();

//updateUsuario(int $id, string $nombre, string $telefono, string $email)

$id = 3;
if ($productos->delete_productoxid($id)) {
    echo "Producto {$id} borrado correctamente.";
} else {
    echo "Error al borrar el  producto: {$id}.";
}


$producto = $productos->get_producto();
print_r('<pre>');
print_r($producto);
print_r('</pre>');
