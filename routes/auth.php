<?php
require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/../controllers/AuthController.php';

$auth = new AuthController($koneksi);

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? null;

if ($method === 'POST' && $action === 'login') {
    $auth->login();
    exit;
}

if ($method === 'POST' && $action === 'register') {
    $auth->register();
    exit;
}

http_response_code(400);
echo json_encode([
    'message' => 'Action auth tidak valid'
]);
exit;
