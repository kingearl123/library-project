<?php
require_once __DIR__ . '../../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware {

    private static $secret = "PERPUS_SECRET_KEY_1234567890abcdef";

    public static function check() {

        // ambil header (case-insensitive)
        $headers = array_change_key_case(getallheaders(), CASE_LOWER);

        if (!isset($headers['authorization'])) {
            http_response_code(401);
            exit(json_encode([
                'message' => 'Token tidak ada'
            ]));
        }

        $token = str_replace("Bearer ", "", $headers['authorization']);
        try {
            return JWT::decode(
                $token,
                new Key(self::$secret, 'HS256')
            );
        } catch (Exception $e) {
            http_response_code(401);
            exit(json_encode([
                'message' => 'Token invalid',
                'error' => $e->getMessage()
            ]));
        }
    }
}