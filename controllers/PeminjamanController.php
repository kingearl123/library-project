<?php
require_once __DIR__ . '/../models/Peminjaman.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class PeminjamanController {
    private $model;

    public function __construct($db) {
        $this->model = new Peminjaman($db);
    }

    public function index() {
        AuthMiddleware::check();
        $result = $this->model->all();
        echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));
    }

    public function store() {
        $auth = AuthMiddleware::check();
        $data = json_decode(file_get_contents("php://input"), true);
        $this->model->create($data, $auth->data->id_user);
        echo json_encode(['message' => 'Peminjaman berhasil']);
    }

    public function kembali($id) {
        AuthMiddleware::check();
        $this->model->kembali($id);
        echo json_encode(['message' => 'Buku dikembalikan']);
    }

    public function destroy($id_peminjaman) {
        AuthMiddleware::check();

        if (!$id_peminjaman) {
            http_response_code(400);
            echo json_encode(['message' => 'ID Peminjaman wajib diisi']);
            exit;
        }

        $this->model->delete($id_peminjaman);
        echo json_encode(['message' => 'Peminjaman dihapus']);
    }

}