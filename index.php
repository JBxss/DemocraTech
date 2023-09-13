<?php

require 'vendor/autoload.php';
require 'classes/Candidatos.php';
require 'classes/Votantes.php';
require 'classes/Votos.php';

Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=APIVotaciones', 'root', ''));

$candidatos = new Candidatos();
$votantes = new Votantes();
$votos = new Votos();

Flight::route('POST /votantes', [$votantes, 'resgistrarVotante']);
Flight::route('POST /candidatos', [$candidatos, 'resgistrarCandidato']);
Flight::route('POST /voto', [$votos, 'resgistrarVoto']);

Flight::start();