<?php
require_once __DIR__ . '/../models/Mahasiswa.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class MahasiswaController {
    private $model;

    public function __construct($db) {
        $this->model = new Mahasiswa($db);
    }

    public function index() {
        AuthMiddleware::check();
        $result = $this->model->all();
        echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));
    }

    public function store() {
        AuthMiddleware::check();
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data) {
            http_response_code(400);
            echo json_encode(['message' => 'Body JSON tidak valid']);
            exit;
        }

        $this->model->create($data);
        echo json_encode(['message' => 'Mahasiswa ditambahkan']);
    }

    public function update($nim) {
        AuthMiddleware::check();

        if (!$nim) {
            http_response_code(400);
            echo json_encode(['message' => 'NIM wajib diisi']);
            exit;
        }

        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data) {
            http_response_code(400);
            echo json_encode(['message' => 'Body JSON tidak valid']);
            exit;
        }

        $this->model->update($nim, $data);
        echo json_encode(['message' => 'Mahasiswa diupdate']);
    }

    public function destroy($nim) {
        AuthMiddleware::check();

        if (!$nim) {
            http_response_code(400);
            echo json_encode(['message' => 'NIM wajib diisi']);
            exit;
        }

        $this->model->delete($nim);
        echo json_encode(['message' => 'Mahasiswa dihapus']);
    }
}
