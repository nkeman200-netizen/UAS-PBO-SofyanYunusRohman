<?php
class Koneksi {
    private $host = "localhost";
    private $username = "root";
    private $password = ""; 
    private $db_name = "db_uas_pbo_ti1d_sofyanyunusrohman";
    
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        
        if ($this->conn->connect_error) {
            die("Koneksi Database Gagal: " . $this->conn->connect_error);
        }
    }
}