<?php
require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/../controllers/PeminjamanController.php';

$controller = new PeminjamanController($koneksi);
$method = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;

if ($method === 'GET') $controller->index();
if ($method === 'POST') $controller->store();
if ($method === 'PUT') $controller->kembali($id);