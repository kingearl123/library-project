<?php
class Mahasiswa {
    private $db;
    private $table = "mahasiswa";

    public function __construct($db) {
        $this->db = $db;
    }

    public function all() {
        return mysqli_query($this->db, "SELECT * FROM {$this->table}");
    }

    public function create($data) {
        $sql = "INSERT INTO {$this->table}
                (nim, nama_mahasiswa, jurusan, angkatan, email)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($this->db, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "sssis",
            $data['nim'],
            $data['nama_mahasiswa'],
            $data['jurusan'],
            $data['angkatan'],
            $data['email']
        );

        return mysqli_stmt_execute($stmt);
    }

    public function update($nim, $data) {
        $sql = "UPDATE {$this->table}
                SET nama_mahasiswa=?,
                    jurusan=?,
                    angkatan=?,
                    email=?
                WHERE nim=?";

        $stmt = mysqli_prepare($this->db, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "ssiss",
            $data['nama_mahasiswa'],
            $data['jurusan'],
            $data['angkatan'],
            $data['email'],
            $nim
        );

        return mysqli_stmt_execute($stmt);
    }

    public function delete($nim) {
        $sql = "DELETE FROM {$this->table} WHERE nim=?";
        $stmt = mysqli_prepare($this->db, $sql);
        mysqli_stmt_bind_param($stmt, "s", $nim);

        return mysqli_stmt_execute($stmt);
    }
}
