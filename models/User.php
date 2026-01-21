<?php
class User {
    private $db;
    private $table = "users";

    public function __construct($db) {
        $this->db = $db;
    }

    public function findByUsername($username) {
        $sql = "SELECT * FROM $this->table WHERE username=?";
        $stmt = mysqli_prepare($this->db, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    }

    public function create($data) {
        $sql = "INSERT INTO users (username,password,role) VALUES (?,?,?)";
        $stmt = mysqli_prepare($this->db, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "sss",
            $data['username'],
            $data['password'],
            $data['role']
        );
        mysqli_stmt_execute($stmt);
    }
}
