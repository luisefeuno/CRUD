<?php
// Fichero testinsert.php
// Este fichero se encarga de probar la inserción de un usuario en la base de datos 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'Productos.php';

$productos = new Productos();

if ($productos->insert_producto("USB 6.0GB")) {
    echo "Producto insertado correctamente.";
} else {
    echo "Error al insertar Producto";
}


$producto = $productos->get_producto();

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
