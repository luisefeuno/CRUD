<?php
require_once "../config/conexion.php";
// require_once "../config/funciones.php";
require_once "../models/Productos.php";

$producto = new Productos();

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
            $producto->insert_producto($_POST["prod_nom"], $_POST["oferta"], $_POST["estadoProducto"], $_POST["paisesId"]);
        } else {
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
