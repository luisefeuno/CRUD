<?php
// Fichero testMostrar.php
// Este fichero se encarga de probar la muestra de los usuarios en la base de datos
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'Paises.php';

$paises = new Paises();
$pais = $paises->get_pais();

if ($pais !== false) {
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
    print_r($pais);
    print_r('</pre>');
} else {
    echo "Error al mostrar el pais";
}


$pais = $paises->get_paisxid(3);

if ($pais !== false) {
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
    print_r($pais);
    print_r('</pre>');
} else {
    echo "Error al mostrar el pais";
}
