<?php
require_once "../config/conexion.php";
// require_once "../config/funciones.php";
require_once "../models/Productos.php";

require_once '../config/funciones.php'; // ✅ Se incluye correctamente el archivo de conexión

$registro = new RegistroActividad(); // ✅ Se crea una instancia de la clase RegistroActividad
$producto = new Productos();


// Función para escribir en el log - Desarrollo
function writeToLog($logData)
{
    $logFile = "../public/logs/log_" . date("Ymd") . ".txt"; // Nombre del archivo de log
    $logMessage = "[" . date("Y-m-d H:i:s") . "] " . json_encode($logData, JSON_UNESCAPED_UNICODE) . "\n";
    file_put_contents($logFile, $logMessage, FILE_APPEND);
}


switch ($_GET["op"]) {

    case "listar":
        $datos = $producto->get_producto();
        $data = array();
        foreach ($datos as $row) {
            $data[] = array(
                "prod_id" => $row["prod_id"],
                "prod_nom" => $row["prod_nom"],
                "fech_crea" => $row["fech_crea"],
                "fech_modi" => $row["fech_modi"],
                "fech_elim" => $row["fech_elim"],
                "est" => $row["est"],
                "oferta" => $row["oferta"],
                "estadoProducto" => $row["estadoProducto"],
                "paisesId" => $row["paisesId"],
                "descrPais" => $row["descrPais"]
            );
        }

        $results = array(
            "draw" => 1,
            "recordsTotal" => count($data),
            "recordsFiltered" => count($data),
            "data" => $data
        );

        header('Content-Type: application/json');
        echo json_encode($results, JSON_UNESCAPED_UNICODE);
        break;

    case "guardaryeditar":
        if (empty($_POST["prod_id"])) {
            /////////////////////////////////////////////
            // Estamos en la insercion de un producto  //
            /////////////////////////////////////////////

            // $lastInsert = $producto->insert_producto($_POST["prod_nom"], $_POST["oferta"], $_POST//["estadoProducto"], $_POST["paisesId"]);

            // Insertar la imagen del producto
            if (isset($_FILES["prod_img"]) && !empty($_FILES["prod_img"]["name"])) {

                //$_POST["prod_img"] es un objeto File.
                $file = $_FILES["prod_img"];
                $fileName = $file["name"];
                $fileTmpName = $file["tmp_name"];
                $fileError = $file["error"];

                // Directorio de publicación de las imagenes
                // $uploadDir = "../public/img/productos/";
                $uploadDir = "../public/img/productos/";
                $fileDestination = $uploadDir . $fileName;

                if ($fileError === UPLOAD_ERR_OK) {
                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        // Insertar en la base de datos real.
                        $lastInsert = $producto->insert_producto(
                            $_POST["prod_nom"],
                            $_POST["oferta"],
                            $_POST["estadoProducto"],
                            $_POST["paisesId"]
                        );
                        // Insertar la imagen en la base de datos
                        $producto->insert_img_producto($lastInsert, $fileName, $uploadDir);
                    } else {
                        // Para desarrollo --> Utilizar OK
                        //$response = array(
                        //    "status" => "error",
                        //    "message" => "Error al subir la imagen - 1 ",
                        //    "fileError" => $fileError . ' ' . $fileTmpName . ' ' . $fileDestination // Incluir el valor de fileError
                        //);
                        //writeToLog($response);

                        // Para producción --> OK
                        $registro->registrarActividad(
                            'admin',
                            'producto.php',
                            'move_uploaded_file',
                            "Error al subir la imagen " . $fileDestination,
                            "error"
                        );

                        http_response_code(500); // Establecer el código de estado HTTP a 500 (Error interno del servidor)
                        echo 'error: Destino no encontrado'; // Necesario para que no se muestre el error en la pantalla, pero el AJAX lo recibe
                        exit; // Importante: Detener la ejecución del script después de enviar el error
                        break;
                    } // if (move_uploaded_file($fileTmpName, $fileDestination))
                } else {

                    // Para desarrollo --> Utilizar OK
                    //$response = array(
                    //    "status" => "error",
                    //    "message" => "Error al subir la imagen - 2",
                    //    "fileError" => $fileError // Incluir el valor de fileError
                    //);
                    //writeToLog($response);

                    // Para producción --> OK
                    $registro->registrarActividad(
                        'admin',
                        'producto.php',
                        'move_uploaded_file',
                        "Error al subir la imagen: UPLOAD_ERROR " . $fileDestination,
                        "error"
                    );

                    http_response_code(500); // Establecer el código de estado HTTP a 500 (Error interno del servidor)
                    echo 'error: UPLOAD_ERROR'; // Necesario para que no se muestre el error en la pantalla, pero el AJAX lo recibe
                    exit; // Importante: Detener la ejecución del script después de enviar el error
                    break;
                } // if ($fileError === UPLOAD_ERR_OK)
            } else { // if (isset($_FILES["prod_img"]) && !empty($_FILES["prod_img"]["name"]))

                // Para desarrollo --> Utilizar OK
                //$response = array(
                //    "status" => "error",
                //    "message" => "Nombre vacio",
                //    "fileError" => ($_FILES["prod_img"]["name"]) // Incluir el valor de fileError
                //);
                //writeToLog($response);

                // Para producción --> OK
                $registro->registrarActividad(
                    'admin',
                    'producto.php',
                    'move_uploaded_file',
                    "Error al subir la imagen: NOMBRE FICHERO " . $fileDestination,
                    "error"
                );
                http_response_code(500); // Establecer el código de estado HTTP a 500 (Error interno del servidor)
                echo 'error: NOMBRE FICHERO'; // Necesario para que no se muestre el error en la pantalla, pero el AJAX lo recibe
                exit; // Importante: Detener la ejecución del script después de enviar el error
                break;
            } // if (isset($_FILES["prod_img"]) && !empty($_FILES["prod_img"]["name"]))

        } else {
            ///////////////////////////////////////////
            // Estamos en la edición de un producto  //
            ///////////////////////////////////////////

            $producto->update_producto($_POST["prod_id"], $_POST["prod_nom"], $_POST["oferta"], $_POST["estadoProducto"], $_POST["paisesId"]);
        }


        break;

    case "mostrar":
        $datos = $producto->get_productoxid($_POST["prod_id"]);
        // if (is_array($datos) == true and count($datos) > 0) {
        //     foreach ($datos as $row) {
        //         $output["prod_id"] = $row["prod_id"];
        //         $output["prod_nom"] = $row["prod_nom"];
        //     }
        // }
        //echo json_encode($output);
        header('Content-Type: application/json');
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
        break;



        
    case "eliminar":
        $producto->delete_productoxid($_POST["prod_id"]);
        break;

    case "activar":
        $producto->activar_productoxid($_POST["prod_id"]);
        break;
}
