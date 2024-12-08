<?php

namespace App\Libraries;

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class JwtLibrary
{
    protected $key;

    public function __construct()
    {
        $this->key = 'simsweb_security'; // Secret key for encoding/decoding JWT
    }

    public function is_jwt_valid($jwt)
    {
        try {
            // Decode the JWT
            $decoded = JWT::decode($jwt, new Key($this->key, 'HS256'));
            // Check if the token is expired
            if ($decoded->exp < time()) {
                return false;
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function encode($payload)
    {
        return JWT::encode($payload, $this->key, 'HS256');
    }

    public function decode($jwt)
    {
        return JWT::decode($jwt, new Key($this->key, 'HS256'));
    }
}
