<?php 

require_once('mahasiswa.php');
class MahasiswaMandiri extends mahasiswa{
    protected $golonganUkt;
    protected $namaWakil;

    public function __construct($id_mahasiswa,$nama_mahasiswa,$nim,$semester,$tarifUktNominal,$goolonganUkt,$namaWakil) {
        parent::__construct($id_mahasiswa,$nama_mahasiswa,$nim,$semester,$tarifUktNominal);
        $this->golonganUkt=$goolonganUkt;
        $this->namaWakil=$namaWakil;
    }

    public function getDaftarMandiri($db) {
        $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembayaran = 'Mandiri'";
        return $db->conn->query($sql);
    }

    public function hitungTagihanSemester(){

    }

    public function tampilkanSpesifikasiAkademik(){
        
    }
}