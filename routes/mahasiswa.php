<?php
require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/../controllers/MahasiswaController.php';

$controller = new MahasiswaController($koneksi);



$nim = $_GET['nim'] ?? null;

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $controller->index();
        break;

    case 'POST':
        $controller->store();
        break;

    case 'PUT':
        $controller->update($nim);
        break;

    case 'DELETE':
        $controller->destroy($nim);
        break;
}
