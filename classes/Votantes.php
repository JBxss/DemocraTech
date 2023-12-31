<?php

require 'vendor/autoload.php';

class Votantes
{
    function resgistrarVotante()
    {

        $db = Flight::db();

        $numero = Flight::request()->data->numero_votante;
        $nombre = Flight::request()->data->nombre_votante;
        $apellido = Flight::request()->data->apellido_votante;
        $tipo = Flight::request()->data->tipo_votante;
        $genero = Flight::request()->data->genero_votante;
        $localidad = Flight::request()->data->localidad_votante;

        // Realiza validaciones
        $errores = [];
        $generosValidos = ["Masculino", "Femenino", "Otro"];

        if (empty($numero) || !is_numeric($numero)) {
            $errores[] = "EL numero de Documento es invalida";
        }

        if (empty($nombre)) {
            $errores[] = "El nombre es obligatorio";
        } elseif (strlen($nombre) < 2 || strlen($nombre) > 50) {
            $errores[] = "El nombre debe tener entre 2 y 50 caracteres.";
        }

        if (empty($apellido)) {
            $errores[] = "El apellido es obligatorio";
        } elseif (strlen($apellido) < 2 || strlen($apellido) > 50) {
            $errores[] = "El apellido debe tener entre 2 y 50 caracteres.";
        }

        if (empty($tipo)) {
            $errores[] = "El tipo de documento es obligatorio";
        }

        if (empty($genero)) {
            $errores[] = "El genero es obligatorio";
        } elseif (!in_array($genero, $generosValidos)) {
            $errores[] = "El genero no es valido. Debe ser 'Masculino', 'Femenino' u 'Otro'.";
        }

        if (empty($localidad)) {
            $errores[] = "La localidad es obligatorio";
        }

        if (!empty($errores)) {
            Flight::halt(400, json_encode(
                [
                    "error" => $errores,
                    "status" => "Error",
                    "code" => "400"
                ]
            ));
        } else {

            $query = $db->prepare("INSERT INTO tbl_votantes (numero_votante, nombre_votante, apellido_votante, tipo_votante, genero_votante, localidad_votante) VALUES (:numero, :nombre, :apellido, :tipo, :genero, :localidad)");

            if ($query->execute([":numero" => $numero, ":nombre" => $nombre, ":apellido" => $apellido, ":tipo" => $tipo, ":genero" => $genero, ":localidad" => $localidad])) {

                $array = [
                    "Nuevo_Votante" => [
                        "No. Documento" => $numero,
                        "Nombre" => $nombre,
                        "Apellido" => $apellido,
                        "Tipo de Documento" => $tipo,
                        "Genero" => $genero,
                        "Localidad" => $localidad
                    ],
                    "status" => "success",
                    "code" => "200",
                ];
            } else {
                Flight::halt(500, json_encode(
                    [
                        "error" => "Hubo un error al agregar los registros",
                        "status" => "Error",
                        "code" => "500"
                    ]
                ));
            }
        }

        Flight::json($array);
    }
}
