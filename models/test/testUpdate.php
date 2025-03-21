<?php
// Fichero testinsert.php
// Este fichero se encarga de probar la inserción de un usuario en la base de datos 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'Productos.php';

$productos = new Productos();

if ($productos->update_producto(3, "Ratón GAMER")) {
    echo "Producto actualizado correctamente.";
} else {
    echo "Error al actualizar Producto";
}


$producto = $productos->get_productoxid(3);

if ($producto !== false) {
    // Primera forma de mostrar los usuarios
    /*    foreach ($usuarios as $usuario) {
        echo "ID: " . $usuario['id'] . "<br>";
        echo "Nombre: " . $usuario['nombre'] . "<br>";
        echo "Teléfono: " . $usuario['telefono'] . "<br>";
        echo "Email: " . $usuario['email'] . "<br>";
        echo "<hr>";
    }*/

    // Segunda forma de mostrar los usuarios
    print_r('<pre>');
    print_r($producto);
    print_r('</pre>');
} else {
    echo "Error al mostrar el producto";
}
