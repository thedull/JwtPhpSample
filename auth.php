<?php
require_once(__DIR__.'/vendor/autoload.php');
try {
    $response = array('success' => false, 'data' => array(), 'message' => '');

    $handler = new \SolStar\RequestAuthorizationHandler();
    $token = $handler->getToken();

    if (\SolStar\JwtHandler::$error == null) {
        $response['data'] = (array) SolStar\JwtHandler::parseToken($token);
        $response['success'] = true;
        $response['message'] = 'Token validation successful';
    }
    else {
        $response['message'] = 'Invalid token.'.\SolStar\JwtHandler::$error;
    }
}
catch (Exception $exc) {
    $response['message'] = $exc->getMessage();
}

header('Content-type: application/json');
echo(json_encode($response));