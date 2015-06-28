<?php
require_once(__DIR__.'/vendor/autoload.php');

extract($_REQUEST);
$returnData = array('success' => false, 'data' => array(), 'message' => '');
if (UserRepository::authenticateUser($username, $password)) {
    $userData = UserRepository::getUserData($username);
    $data = array(
        'user' => $username,
        'userName' => $userData['userName']
    );
    $token = SolStar\JwtHandler::generateToken($data);
    $returnData['success'] = true;
    $returnData['data'] = array('token' => $token);
    $returnData['message'] = 'Authentication successful';
} else {
    $returnData['message'] = 'Authentication failed';
}
header('Content-type: application/json');
echo json_encode($returnData);


class UserRepository {
    private static $userList = array(
        array('user' => 'user1', 'data' => array('userName' => 'User 1', 'password' => 'user123')),
        array('user' => 'user2', 'data' => array('userName' => 'User 2', 'password' => 'user222')),
        array('user' => 'user3', 'data' => array('userName' => 'User 3', 'password' => 'user333'))
    );

    public static function getUserData($user) {
        $data = null;
        foreach (self::$userList as $value) {
            if ($value['user'] === $user) {
                $data = $value['data'];
                break;
            }
        }
        return $data;
    }

    public static function authenticateUser($user, $password) {
        $found = false;
        foreach (self::$userList as $key => $value) {
            if ($value['user'] === $user && $password === $value['data']['password']) {
                $found = true;
                break;
            }
        }
        return $found;
    }
}