<?php 
require_once('mahasiswa.php');

class MahasiswaBidikmisi extends mahasiswa {
    protected $nomorKipKuliah;
    protected $danaSakuSubsidi;

    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $nomorKipKuliah, $danaSakuSubsidi) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->nomorKipKuliah = $nomorKipKuliah;
        $this->danaSakuSubsidi = $danaSakuSubsidi;
    }

    // WAJIB ADA LIMIT & OFFSET DI SINI
    public function getDaftarBidikmisi($db, $limit = 5, $offset = 0) {
        $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembayaran = 'Bidikmisi' LIMIT $limit OFFSET $offset";
        return $db->conn->query($sql);
    }

    public function countBidikmisi($db) {
        $sql = "SELECT COUNT(*) as total FROM tabel_mahasiswa WHERE jenis_pembayaran = 'Bidikmisi'";
        $result = $db->conn->query($sql);
        return $result->fetch_assoc()['total'];
    }

    public function hitungTagihanSemester() {
        return 0;
    }

    public function tampilkanSpesifikasiAkademik() {
        return "No. KIP: " . $this->nomorKipKuliah . " | Subsidi: Rp " . number_format($this->danaSakuSubsidi, 0, ',', '.');
    }
}
?>