<?php

namespace SolStar;

class JwtHandler
{
    public static $key = 'private123456';
    public static $error = null;

    public static function generateToken(Array $data)
    {
        $token = \JWT::encode($data, self::$key);
        return $token;
    }

    public static function parseToken($token)
    {
        $data = null;
        try {
            $data = \JWT::decode($token, self::$key, array('HS256'));
        } catch (\Exception $exc) {
            self::$error = $exc->getMessage();
        }
        return $data;
    }

}