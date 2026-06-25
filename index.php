<?php
require_once "koneksi.php";
require_once "mahasiswaMandiri.php";
require_once "mahasiswaBidikmisi.php";
require_once "mahasiswaPrestasi.php";

$db = new Koneksi();

// Tentukan Tab yang sedang aktif (default: mandiri)
$activeTab = $_GET['tab'] ?? 'mandiri';

// Pengaturan Pagination (Batasi 5 data per halaman)
$limit = 5;

// Tangkap nomor halaman untuk masing-masing tab
$pageMandiri = ($activeTab == 'mandiri') ? ($_GET['page'] ?? 1) : 1;
$pageBidikmisi = ($activeTab == 'bidikmisi') ? ($_GET['page'] ?? 1) : 1;
$pagePrestasi = ($activeTab == 'prestasi') ? ($_GET['page'] ?? 1) : 1;

// Hitung Offset (Data ke berapa yang mulai diambil)
$offsetMandiri = ($pageMandiri - 1) * $limit;
$offsetBidikmisi = ($pageBidikmisi - 1) * $limit;
$offsetPrestasi = ($pagePrestasi - 1) * $limit;

$helperMandiri = new MahasiswaMandiri(0, '', '', 0, 0, '', '');
$helperBidikmisi = new MahasiswaBidikmisi(0, '', '', 0, 0, '', 0);
$helperPrestasi = new MahasiswaPrestasi(0, '', '', 0, 0, '', 0);

// Ambil Data Terbatas & Hitung Total Halaman
$dataMandiri = $helperMandiri->getDaftarMandiri($db, $limit, $offsetMandiri);
$totalPagesMandiri = ceil($helperMandiri->countMandiri($db) / $limit);

$dataBidikmisi = $helperBidikmisi->getDaftarBidikmisi($db, $limit, $offsetBidikmisi);
$totalPagesBidikmisi = ceil($helperBidikmisi->countBidikmisi($db) / $limit);

$dataPrestasi = $helperPrestasi->getDaftarPrestasi($db, $limit, $offsetPrestasi);
$totalPagesPrestasi = ceil($helperPrestasi->countPrestasi($db) / $limit);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi UKT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-slate-50 text-slate-800 font-sans p-6">

    <div class="max-w-6xl mx-auto">
        <header class="flex items-center gap-3 bg-blue-600 text-white p-5 rounded-xl shadow-lg mb-8">
            <span class="material-icons text-4xl">school</span>
            <div>
                <h1 class="text-2xl font-bold">Dashboard Pembayaran UKT</h1>
                <p class="text-blue-100 text-sm">Universitas PBO - Manajemen Jalur Spesifik</p>
            </div>
        </header>

        <div class="flex gap-2 mb-6 border-b border-slate-300 pb-2">
            <button onclick="changeTab('mandiri')" id="btn-mandiri" class="tab-btn px-4 py-2 font-semibold text-slate-500 hover:text-blue-600 flex items-center gap-2 transition-all">
                <span class="material-icons text-sm">account_balance_wallet</span> Mandiri
            </button>
            <button onclick="changeTab('bidikmisi')" id="btn-bidikmisi" class="tab-btn px-4 py-2 font-semibold text-slate-500 hover:text-blue-600 flex items-center gap-2 transition-all">
                <span class="material-icons text-sm">workspace_premium</span> Bidikmisi
            </button>
            <button onclick="changeTab('prestasi')" id="btn-prestasi" class="tab-btn px-4 py-2 font-semibold text-slate-500 hover:text-blue-600 flex items-center gap-2 transition-all">
                <span class="material-icons text-sm">emoji_events</span> Prestasi
            </button>
        </div>

        <div id="mandiri" class="tab-content hidden bg-white rounded-xl shadow p-5">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-100 text-slate-600 text-sm uppercase border-b">
                        <th class="p-3">NIM</th>
                        <th class="p-3">Nama Mahasiswa</th>
                        <th class="p-3">Tagihan UKT</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $dataMandiri->fetch_assoc()): 
                        $mhs = new MahasiswaMandiri(0, $row['nama_mahasiswa'], $row['nim'], 0, $row['tarif_ukt_nominal'], '', '');
                    ?>
                    <tr class="border-b hover:bg-slate-50">
                        <td class="p-3 font-medium"><?= $row['nim'] ?></td>
                        <td class="p-3"><?= $row['nama_mahasiswa'] ?></td>
                        <td class="p-3 font-bold text-blue-600">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.') ?></td>
                        <td class="p-3 text-center">
                            <a href="detail.php?id=<?= $row['id_mahasiswa'] ?>&jalur=Mandiri" class="inline-flex items-center gap-1 bg-blue-500 text-white px-3 py-1.5 rounded-lg text-sm hover:bg-blue-600 shadow-sm transition">
                                <span class="material-icons text-[16px]">visibility</span> Detail
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <div class="mt-5 flex justify-between items-center border-t pt-4">
                <span class="text-sm text-slate-500">Menampilkan Halaman <?= $pageMandiri ?> dari <?= $totalPagesMandiri ?></span>
                <div class="flex gap-1">
                    <?php for($i=1; $i<=$totalPagesMandiri; $i++): ?>
                        <a href="?tab=mandiri&page=<?= $i ?>" class="px-3 py-1 border rounded <?= ($i == $pageMandiri) ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-slate-600 hover:bg-slate-100' ?>"><?= $i ?></a>
                    <?php endfor; ?>
                </div>
            </div>
        </div>

        <div id="bidikmisi" class="tab-content hidden bg-white rounded-xl shadow p-5">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-100 text-slate-600 text-sm uppercase border-b">
                        <th class="p-3">NIM</th>
                        <th class="p-3">Nama Mahasiswa</th>
                        <th class="p-3">Tagihan UKT</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $dataBidikmisi->fetch_assoc()): 
                        $mhs = new MahasiswaBidikmisi(0, $row['nama_mahasiswa'], $row['nim'], 0, $row['tarif_ukt_nominal'], '', 0);
                    ?>
                    <tr class="border-b hover:bg-slate-50">
                        <td class="p-3 font-medium"><?= $row['nim'] ?></td>
                        <td class="p-3"><?= $row['nama_mahasiswa'] ?></td>
                        <td class="p-3 font-bold text-emerald-600"><span class="bg-emerald-100 text-emerald-700 px-2 py-1 rounded-md text-xs border border-emerald-200">GRATIS</span></td>
                        <td class="p-3 text-center">
                            <a href="detail.php?id=<?= $row['id_mahasiswa'] ?>&jalur=Bidikmisi" class="inline-flex items-center gap-1 bg-blue-500 text-white px-3 py-1.5 rounded-lg text-sm hover:bg-blue-600 shadow-sm transition">
                                <span class="material-icons text-[16px]">visibility</span> Detail
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <div class="mt-5 flex justify-between items-center border-t pt-4">
                <span class="text-sm text-slate-500">Menampilkan Halaman <?= $pageBidikmisi ?> dari <?= $totalPagesBidikmisi ?></span>
                <div class="flex gap-1">
                    <?php for($i=1; $i<=$totalPagesBidikmisi; $i++): ?>
                        <a href="?tab=bidikmisi&page=<?= $i ?>" class="px-3 py-1 border rounded <?= ($i == $pageBidikmisi) ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-slate-600 hover:bg-slate-100' ?>"><?= $i ?></a>
                    <?php endfor; ?>
                </div>
            </div>
        </div>

        <div id="prestasi" class="tab-content hidden bg-white rounded-xl shadow p-5">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-100 text-slate-600 text-sm uppercase border-b">
                        <th class="p-3">NIM</th>
                        <th class="p-3">Nama Mahasiswa</th>
                        <th class="p-3">Tagihan UKT</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $dataPrestasi->fetch_assoc()): 
                        $mhs = new MahasiswaPrestasi(0, $row['nama_mahasiswa'], $row['nim'], 0, $row['tarif_ukt_nominal'], '', 0);
                    ?>
                    <tr class="border-b hover:bg-slate-50">
                        <td class="p-3 font-medium"><?= $row['nim'] ?></td>
                        <td class="p-3"><?= $row['nama_mahasiswa'] ?></td>
                        <td class="p-3 font-bold text-amber-600">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.') ?></td>
                        <td class="p-3 text-center">
                            <a href="detail.php?id=<?= $row['id_mahasiswa'] ?>&jalur=Prestasi" class="inline-flex items-center gap-1 bg-blue-500 text-white px-3 py-1.5 rounded-lg text-sm hover:bg-blue-600 shadow-sm transition">
                                <span class="material-icons text-[16px]">visibility</span> Detail
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <div class="mt-5 flex justify-between items-center border-t pt-4">
                <span class="text-sm text-slate-500">Menampilkan Halaman <?= $pagePrestasi ?> dari <?= $totalPagesPrestasi ?></span>
                <div class="flex gap-1">
                    <?php for($i=1; $i<=$totalPagesPrestasi; $i++): ?>
                        <a href="?tab=prestasi&page=<?= $i ?>" class="px-3 py-1 border rounded <?= ($i == $pagePrestasi) ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-slate-600 hover:bg-slate-100' ?>"><?= $i ?></a>
                    <?php endfor; ?>
                </div>
            </div>
        </div>

    </div>

    <footer class="mt-8 py-4 border-t border-slate-200 text-center text-slate-400 text-xs font-medium">
        &copy; <?php echo date('Y'); ?> Universitas PBO &bull; Dikembangkan oleh Sofyan Yunus Rohman
    </footer>

    <script>
        // Fungsi untuk mengganti tab dan mengubah URL tanpa reload
        function changeTab(tabName) {
            window.location.href = '?tab=' + tabName + '&page=1';
        }

        // Fungsi untuk membuka tab saat pertama halaman dirender (berdasarkan URL)
        document.addEventListener("DOMContentLoaded", function() {
            let activeTab = "<?= $activeTab ?>";
            
            // Sembunyikan semua konten dan matikan warna tombol
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
                btn.classList.add('text-slate-500');
            });
            
            // Nyalakan tab yang sesuai URL
            document.getElementById(activeTab).classList.remove('hidden');
            let activeBtn = document.getElementById('btn-' + activeTab);
            activeBtn.classList.remove('text-slate-500');
            activeBtn.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
        });
    </script>
</body>
</html>