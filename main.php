<?php

require_once(__DIR__.'/vendor/autoload.php');

// PROCESO LOGIN:
// Recibir datos de usr y pwd.
// Validar usr/pwd contra BD.
// Asignar a usr el login, asignar a userName el nombre de us, etc...

$data = array(
    'user' => 'usr1',
    'userName' => 'User 1'
);

$token = SolStar\JwtHandler::generateToken($data);

echo($token);
// Redirección

// AJAX REQUEST:
// Adicionar un header
// headers: {'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjoidXNyMSIsInVzZXJOYW1lIjoiVXNlciAxIn0.jVfzRScxdrGpEaEpnOBdLtgrgw70L0YILBQanx2zk5Q'}
// Clase que reciba request y valide/interprete el header 'Autorization' y asigna cada valor a las variables de sesion
$handler = new \SolStar\RequestAuthorizationHandler();
$token2 = $handler->getToken();
$data = (array) SolStar\JwtHandler::parseToken($token2);

echo SolStar\JwtHandler::$error;
print_r($data);

