<?php
header("Content-Type: application/json");

// ambil path TANPA query string
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri  = explode("/", trim($path, "/"));

$endpoint = $uri[2] ?? null;

if ($endpoint === 'auth') {
    require __DIR__ . '/routes/auth.php';
    exit;
}

if ($endpoint === 'mahasiswa') {
    require __DIR__ . '/routes/mahasiswa.php';
    exit;
}
if ($endpoint === 'peminjaman') {
    require __DIR__ . '/routes/peminjaman.php';
    exit;
}
if ($endpoint === 'denda') {
    require __DIR__ . '/routes/denda.php';
    exit;
}

http_response_code(404);
echo json_encode([
    "message" => "Endpoint tidak ditemukan",
    "endpoint" => $endpoint
]);
exit;
