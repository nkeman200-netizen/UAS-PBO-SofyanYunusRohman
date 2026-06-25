<?php 
require_once('mahasiswa.php');

class MahasiswaMandiri extends mahasiswa {
    protected $golonganUkt;
    protected $namaWakil;

    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $golonganUkt, $namaWakil) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->golonganUkt = $golonganUkt;
        $this->namaWakil = $namaWakil;
    }

    // WAJIB ADA LIMIT & OFFSET DI SINI
    public function getDaftarMandiri($db, $limit = 5, $offset = 0) {
        $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembayaran = 'Mandiri' LIMIT $limit OFFSET $offset";
        return $db->conn->query($sql);
    }

    public function countMandiri($db) {
        $sql = "SELECT COUNT(*) as total FROM tabel_mahasiswa WHERE jenis_pembayaran = 'Mandiri'";
        $result = $db->conn->query($sql);
        return $result->fetch_assoc()['total'];
    }

    public function hitungTagihanSemester() {
        return $this->tarifUktNominal + 100000;
    }

    public function tampilkanSpesifikasiAkademik() {
        return "Golongan UKT: " . $this->golonganUkt . " | Nama Wali: " . $this->namaWakil;
    }
}
?>