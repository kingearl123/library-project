<?php
require_once __DIR__ . '/../models/Denda.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class DendaController {
    private $model;

    public function __construct($db) {
        $this->model = new Denda($db);
    }

    public function index() {
        AuthMiddleware::check();
        $result = $this->model->all();
        echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));
    }

    public function store() {
        AuthMiddleware::check();
        $data = json_decode(file_get_contents("php://input"), true);
        $this->model->create($data);
        echo json_encode(['message' => 'Denda ditambahkan']);
    }

    public function bayar($id) {
        AuthMiddleware::check();
        $this->model->bayar($id);
        echo json_encode(['message' => 'Denda dibayar']);
    }
}
