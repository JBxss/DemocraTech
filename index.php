<?php

require 'vendor/autoload.php';
require 'classes/Candidatos.php';
require 'classes/Votantes.php';
require 'classes/Votos.php';

Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=test','user','pass'));

$candidatos = new Candidatos();
$votantes = new Votantes();
$votos = new Votos();

Flight::route('POST /votantes', [$votantes, 'resgistrarVotante']);

Flight::start();