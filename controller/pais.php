<?php
require_once "../config/conexion.php";
require_once "../models/Paises.php";

$pais = new Paises();

switch ($_GET["op"]) {

    case "listar":
        $datos = $pais->get_pais();
        $data = array();
        foreach ($datos as $row) {
            $data[] = array(
                "idpaises" => $row["idpaises"],
                "descrPaises" => $row["descrPaises"],
                "fech_crea" => $row["fech_crea"],
                "fech_modi" => $row["fech_modi"],
                "fech_elim" => $row["fech_elim"],
                "est" => $row["est"],
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
        if (empty($_POST["idpaises"])) {
            $producto->insert_pais($_POST["descrPaises"]);
        } else {
            $producto->update_pais($_POST["idpaises"], $_POST["descrPaises"]);
        }
        break;

    case "mostrar":
        $datos = $pais->get_paisxid($_POST["pais_id"]);
        header('Content-Type: application/json');
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
        break;

    case "eliminar":
        $producto->delete_paisxid($_POST["idpaises"]);
        break;

    case "activar":
        $producto->activar_paisxid($_POST["idpaises"]);
        break;
}
