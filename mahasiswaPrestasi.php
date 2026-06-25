<?php 

require_once('mahasiswa.php');
class MahasiswaPrestasi extends mahasiswa{
    protected $namaInstansiBeasiswa;
    protected $minimalIpk;

    public function __construct($id_mahasiswa,$nama_mahasiswa,$nim,$semester,$tarifUktNominal,$golonganUkt,$minimalIpk) {
        parent::__construct($id_mahasiswa,$nama_mahasiswa,$nim,$semester,$tarifUktNominal);
        $this->namaInstansiBeasiswa=$golonganUkt;
        $this->minimalIpk=$minimalIpk;
    }

    public function getDaftarPrestasi($db) {
        $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembayaran = 'Prestasi'";
        return $db->conn->query($sql);
    }
    
    public function hitungTagihanSemester(){
        $total=$this->tarifUktNominal*0.25;
        return $total;
    }

    public function tampilkanSpesifikasiAkademik(){
        
    }
}