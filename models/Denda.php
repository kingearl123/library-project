<?php
class Denda {
    private $db;
    private $table = "denda";

    public function __construct($db) {
        $this->db = $db;
    }

    public function all() {
        return mysqli_query($this->db, "SELECT * FROM $this->table");
    }

    public function create($data) {
        $stmt = mysqli_prepare(
            $this->db,
            "INSERT INTO $this->table 
             (id_peminjaman,jumlah_denda,status_bayar)
             VALUES (?,?, 'Belum Lunas')"
        );
        mysqli_stmt_bind_param(
            $stmt,
            "id",
            $data['id_peminjaman'],
            $data['jumlah_denda']
        );
        return mysqli_stmt_execute($stmt);
    }

    public function bayar($id) {
        return mysqli_query(
            $this->db,
            "UPDATE $this->table 
             SET status_bayar='Lunas'
             WHERE id_denda=$id"
        );
    }
}