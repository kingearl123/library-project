<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController {

    private $userModel;
    private $secret = "PERPUS_SECRET_KEY_1234567890abcdef";

    public function __construct($db) {
        $this->userModel = new User($db);
    }

    public function login() {
        $data = json_decode(file_get_contents("php://input"), true);

        $user = $this->userModel->findByUsername($data['username']);

        if (!$user || !password_verify($data['password'], $user['password'])) {
            http_response_code(401);
            echo json_encode(['message' => 'Login gagal']);
            return;
        }

        $payload = [
            'iat' => time(),
            'exp' => time() + 3600,
            'data' => [
                'id_user' => $user['id_user'],
                'role' => $user['role']
            ]
        ];

        $token = JWT::encode($payload, $this->secret, 'HS256');

        echo json_encode(['token' => $token]);
    }

    public function register() {
        $data = json_decode(file_get_contents("php://input"), true);
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $this->userModel->create($data);
        echo json_encode(['message' => 'Register berhasil']);
    }
}