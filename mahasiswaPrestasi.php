<?php 
require_once('mahasiswa.php');

class MahasiswaPrestasi extends mahasiswa {
    protected $namaInstansiBeasiswa;
    protected $minimalIpk;

    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $namaInstansiBeasiswa, $minimalIpk) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->namaInstansiBeasiswa = $namaInstansiBeasiswa;
        $this->minimalIpk = $minimalIpk;
    }

    // WAJIB ADA LIMIT & OFFSET DI SINI
    public function getDaftarPrestasi($db, $limit = 5, $offset = 0) {
        $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembayaran = 'Prestasi' LIMIT $limit OFFSET $offset";
        return $db->conn->query($sql);
    }

    public function countPrestasi($db) {
        $sql = "SELECT COUNT(*) as total FROM tabel_mahasiswa WHERE jenis_pembayaran = 'Prestasi'";
        $result = $db->conn->query($sql);
        return $result->fetch_assoc()['total'];
    }

    public function hitungTagihanSemester() {
        return $this->tarifUktNominal * 0.25;
    }

    public function tampilkanSpesifikasiAkademik() {
        return "Instansi: " . $this->namaInstansiBeasiswa . " | Min. IPK: " . $this->minimalIpk;
    }
}
?>