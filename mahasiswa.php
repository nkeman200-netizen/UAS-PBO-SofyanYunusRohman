<?php 

abstract class mahasiswa{
    protected $id_mahasiswa;
    protected $nama_mahasiswa;
    protected $nim;
    protected $semester;
    protected $tarifUktNominal;

    public function __construct($id_mahasiswa,$nama_mahasiswa,$nim,$semester,$tarifUktNominal)
    {
        $this->id_mahasiswa=$id_mahasiswa;
        $this->nama_mahasiswa=$nama_mahasiswa;
        $this->nim=$nim;
        $this->semester=$semester;
        $this->tarifUktNominal=$tarifUktNominal;
    }
    
    public abstract function hitungTagihanSemester();
    public abstract function tampilkanSpesifikasiAkademik();
}