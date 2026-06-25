<?php
require_once "koneksi.php";
require_once "mahasiswaMandiri.php";
require_once "mahasiswaBidikmisi.php";
require_once "mahasiswaPrestasi.php";

$db = new Koneksi();
$id = $_GET['id'] ?? 0;
$jalur = $_GET['jalur'] ?? '';

// Ambil data spesifik berdasarkan ID
$sql = "SELECT * FROM tabel_mahasiswa WHERE id_mahasiswa = $id";
$result = $db->conn->query($sql);

if ($result->num_rows == 0) {
    die("Data tidak ditemukan.");
}
$row = $result->fetch_assoc();

// Instansiasi objek yang tepat berdasarkan parameter GET (Implementasi OOP)
if ($jalur == 'Mandiri') {
    $mhs = new MahasiswaMandiri($row['id_mahasiswa'], $row['nama_mahasiswa'], $row['nim'], $row['semester'], $row['tarif_ukt_nominal'], $row['golongan_ukt'], $row['nama_wakil']);
    $icon = "account_balance_wallet";
    $color = "blue";
} elseif ($jalur == 'Bidikmisi') {
    $mhs = new MahasiswaBidikmisi($row['id_mahasiswa'], $row['nama_mahasiswa'], $row['nim'], $row['semester'], $row['tarif_ukt_nominal'], $row['nomor_kip_kuliah'], $row['dana_saku_subsidi']);
    $icon = "workspace_premium";
    $color = "emerald";
} elseif ($jalur == 'Prestasi') {
    $mhs = new MahasiswaPrestasi($row['id_mahasiswa'], $row['nama_mahasiswa'], $row['nim'], $row['semester'], $row['tarif_ukt_nominal'], $row['nama_instansi_beasiswa'], $row['minimal_ipk_syarat']);
    $icon = "emoji_events";
    $color = "amber";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
        <div class="bg-<?= $color ?>-600 p-6 text-white text-center relative">
            <span class="material-icons text-5xl mb-2"><?= $icon ?></span>
            <h2 class="text-2xl font-bold"><?= $row['nama_mahasiswa'] ?></h2>
            <p class="text-<?= $color ?>-100 font-medium">NIM: <?= $row['nim'] ?> • Semester <?= $row['semester'] ?></p>
            <div class="absolute top-4 right-4 bg-white/20 px-3 py-1 rounded-full text-xs font-bold border border-white/40">
                Jalur <?= $jalur ?>
            </div>
        </div>

        <div class="p-6">
            <div class="mb-4">
                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Total Tagihan Final</p>
                <p class="text-3xl font-black text-slate-800">
                    Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.') ?>
                </p>
            </div>

            <div class="bg-slate-50 border border-slate-200 rounded-lg p-4 mb-6">
                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-2 flex items-center gap-1">
                    <span class="material-icons text-[14px]">info</span> Spesifikasi Akademik
                </p>
                <p class="text-slate-700 font-medium leading-relaxed">
                    <?= $mhs->tampilkanSpesifikasiAkademik(); ?>
                </p>
            </div>

            <a href="index.php" class="flex items-center justify-center gap-2 w-full bg-slate-200 text-slate-700 font-semibold py-3 rounded-xl hover:bg-slate-300 transition">
                <span class="material-icons text-sm">arrow_back</span> Kembali ke Dashboard
            </a>
        </div>
    </div>

</body>
</html>