<?php
require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/../controllers/DendaController.php';

$controller = new DendaController($koneksi);
$method = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;

if ($method === 'GET') $controller->index();
if ($method === 'POST') $controller->store();
if ($method === 'PUT') $controller->bayar($id);