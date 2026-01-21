<?php
class Peminjaman {
    private $db;
    private $table = "peminjaman";

    public function __construct($db) {
        $this->db = $db;
    }

    public function all() {
        $sql = "SELECT p.*, m.nama_mahasiswa
                FROM peminjaman p
                JOIN mahasiswa m ON p.nim = m.nim";
        return mysqli_query($this->db, $sql);
    }

    public function create($data, $id_user) {
        $sql = "INSERT INTO $this->table 
                (nim,id_user,judul_buku,tanggal_pinjam,status)
                VALUES (?,?,?,?, 'Dipinjam')";
        $stmt = mysqli_prepare($this->db, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "siss",
            $data['nim'],
            $id_user,
            $data['judul_buku'],
            $data['tanggal_pinjam']
        );
        return mysqli_stmt_execute($stmt);
    }

    public function kembali($id) {
        return mysqli_query(
            $this->db,
            "UPDATE $this->table
             SET status='Dikembalikan',
                 tanggal_kembali=CURDATE()
             WHERE id_peminjaman=$id"
        );
    }
        public function delete($id_peminjaman) {
        $sql = "DELETE FROM {$this->table} WHERE id_peminjaman=?";
        $stmt = mysqli_prepare($this->db, $sql);
        mysqli_stmt_bind_param($stmt, "s", $id_peminjaman);

        return mysqli_stmt_execute($stmt);
    }
}
