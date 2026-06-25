<?php 

require_once('mahasiswa.php');
class MahasiswaBidikmisi extends mahasiswa{
    protected $nomorKipKuliah;
    protected $danaSakuSubsidi;

    public function __construct($id_mahasiswa,$nama_mahasiswa,$nim,$semester,$tarifUktNominal,$nomorKipKuliah,$danaSakuSubsidi) {
        parent::__construct($id_mahasiswa,$nama_mahasiswa,$nim,$semester,$tarifUktNominal);
        $this->nomorKipKuliah=$nomorKipKuliah;
        $this->danaSakuSubsidi=$danaSakuSubsidi;
    }

    public function getDaftarBidikmisi($db) {
        $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembayaran = 'Bidikmisi'";
        return $db->conn->query($sql);
    }
    
    public function hitungTagihanSemester(){
        $total=0;
        return $total;
    }

    public function tampilkanSpesifikasiAkademik(){
        
    }
}