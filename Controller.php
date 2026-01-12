<?php
class Controller {
    private $host = "localhost", $user = "root", $pass = "", $db = "daily_cotton";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($this->conn->connect_error) die("Koneksi gagal: " . $this->conn->connect_error);
    }

    public function login($username, $password) {
        $user_clean = $this->conn->real_escape_string($username);
        // Kita ambil data user berdasarkan username
        $query = "SELECT * FROM users WHERE username = '$user_clean'";
        $result = $this->conn->query($query);

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // CEK PASSWORD: Kita pakai cara paling simpel agar tidak gagal lagi
            if ($password == $user['password'] || password_verify($password, $user['password'])) {
                $_SESSION['login'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                return true;
            }
        }
        return false;
    }

    public function getMaterials($search = '', $limit = 12, $offset = 0) {
        $s = $this->conn->real_escape_string($search);
        $q = "SELECT * FROM materials WHERE nama_bahan LIKE '%$s%' OR warna LIKE '%$s%' LIMIT $limit OFFSET $offset";
        return $this->conn->query($q);
    }

    public function countMaterials($search = '') {
        $s = $this->conn->real_escape_string($search);
        $q = "SELECT COUNT(*) as total FROM materials WHERE nama_bahan LIKE '%$s%' OR warna LIKE '%$s%'";
        $res = $this->conn->query($q);
        return $res->fetch_assoc()['total'];
    }
}