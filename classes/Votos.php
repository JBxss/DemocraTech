<?php

require 'vendor/autoload.php';

class Votos
{
    function resgistrarVoto()
    {

        $db = Flight::db();

        $id = Flight::request()->data->id_voto;
        $numeroCandidato = Flight::request()->data->numero_candidato;
        $numeroVotante = Flight::request()->data->numero_votante;

        // Realiza validaciones
        $errores = [];

        if (empty($id) || !is_numeric($id)) {
            $errores[] = "La id del voto es invalida";
        }

        if (empty($numeroCandidato) || !is_numeric($numeroCandidato)) {
            $errores[] = "EL numero de Documento del Candidato es invalida";
        }

        if (empty($numeroVotante) || !is_numeric($numeroVotante)) {
            $errores[] = "EL numero de Documento del Votante es invalida";
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

            // Realiza validaciones
            $queryVotante= $db->prepare("SELECT * FROM tbl_votantes WHERE numero_votante = :numeroVotante");
            $queryVotante->execute([":numeroVotante" => $numeroVotante]);
            $dataVotante = $queryVotante->fetch();

            $queryCandidato= $db->prepare("SELECT * FROM tbl_candidatos WHERE numero_candidato = :numeroCandidato");
            $queryCandidato->execute([":numeroCandidato" => $numeroCandidato]);
            $dataCandidato = $queryCandidato->fetch();

            $queryVoto= $db->prepare("SELECT * FROM tbl_votos WHERE numero_votante = :numeroVotante");
            $queryVoto->execute([":numeroVotante" => $numeroVotante]);
            $dataVoto = $queryVoto->fetch();
    
            // Verificar si el votante y el candidato existen en la base de datos
            if (!$dataVotante || !$dataCandidato) {
                Flight::halt(404, json_encode([
                    "error" => "El votante o el candidato no existen",
                    "status" => "error",
                    "code" => "404"
                ]));
            }

            // Verificar si el votante ya ha realizado un voto
            if ($dataVoto) {
                Flight::halt(400, json_encode([
                    "error" => "El votante ya ha realizado un voto",
                    "status" => "error",
                    "code" => "400"
                ]));
            }

            // Verificar si el votante y el candidato pertenecen a la misma localidad
            if ($dataVotante['localidad_votante'] !== $dataCandidato['localidad_candidato']) {
                Flight::halt(400, json_encode(
                    [
                        "error" => "El votante y el candidato pertenecen a localidades diferentes",
                        "status" => "Error",
                        "code" => "400"
                    ]
                ));
            }

            $query = $db->prepare("INSERT INTO tbl_votos (id_voto, numero_candidato, numero_votante) VALUES (:id, :numeroCandidato, :numeroVotante)");

            if ($query->execute([":id" => $id, ":numeroCandidato" => $numeroCandidato, ":numeroVotante" => $numeroVotante])) {

                $array = [
                    "Nuevo_Voto" => [
                        "Id Voto" => $id,
                        "No. Candidato" => $numeroCandidato,
                        "No. Votante" => $numeroVotante
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