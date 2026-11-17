<?php
// 1. DATA PRODUK (Simulasi dari Database)
$produk = [
    [
        "id" => 1,
        "kode" => "PRD001",
        "nama" => "Kemeja Flanel",
        "kategori" => "Kemeja",
        "harga_modal" => 60000,
        "harga_jual" => 120000,
        "stok" => 25,
        "status" => "Aktif"
    ],
    [
        "id" => 2,
        "kode" => "PRD002",
        "nama" => "Celana Jeans",
        "kategori" => "Celana",
        "harga_modal" => 50000,
        "harga_jual" => 150000,
        "stok" => 18,
        "status" => "Aktif"
    ],
    [
        "id" => 3,
        "kode" => "PRD003",
        "nama" => "Gamis Motif",
        "kategori" => "Gamis",
        "harga_modal" => 100000,
        "harga_jual" => 200000,
        "stok" => 12,
        "status" => "Aktif"
    ],
    [
        "id" => 4,
        "kode" => "PRD004",
        "nama" => "Kaos Polos",
        "kategori" => "Kaos",
        "harga_modal" => 30000,
        "harga_jual" => 80000,
        "stok" => 30,
        "status" => "Aktif"
    ],
    [
        "id" => 5,
        "kode" => "PRD005",
        "nama" => "Jaket Hoodie",
        "kategori" => "Jaket",
        "harga_modal" => 120000,
        "harga_jual" => 250000,
        "stok" => 10,
        "status" => "Aktif"
    ],
    [
        "id" => 6,
        "kode" => "PRD006",
        "nama" => "Rok Panjang",
        "kategori" => "Rok",
        "harga_modal" => 70000,
        "harga_jual" => 110000,
        "stok" => 15,
        "status" => "Nonaktif"
    ]
];

// 2. LOGIKA FITUR FILTER & PENCARIAN
$search = isset($_GET['q']) ? trim($_GET['q']) : '';
$filter_kategori = isset($_GET['kategori']) ? $_GET['kategori'] : 'Semua Kategori';
$filter_status = isset($_GET['status']) ? $_GET['status'] : 'Semua Status';

$produk_tampil = array_filter($produk, function($item) use ($search, $filter_kategori, $filter_status) {
    $match_search = empty($search) || (stripos($item['nama'], $search) !== false) || (stripos($item['kode'], $search) !== false);
    $match_kategori = ($filter_kategori === 'Semua Kategori') || ($item['kategori'] === $filter_kategori);
    $match_status = ($filter_status === 'Semua Status') || ($item['status'] === $filter_status);
    
    return $match_search && $match_kategori && $match_status;
});

// List dinamis untuk Dropdown Filter
$kategori_list = array_unique(array_column($produk, 'kategori'));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk & Harga - POS Desktop</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 flex flex-col h-screen overflow-hidden">

    <!-- TOP BAR -->
    <header class="bg-stone-900 text-white h-14 px-6 flex items-center justify-between shadow-md z-10 shrink-0">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-shirt text-xl text-amber-500"></i>
            <div>
                <h1 class="font-bold text-sm tracking-wide">Fashion Store</h1>
                <p class="text-[10px] text-gray-400 -mt-1">Point of Sales (POS)</p>
            </div>
        </div>
        <div class="flex items-center gap-6 text-sm">
            <div class="flex items-center gap-2 text-gray-300">
                <i class="fa-solid fa-circle-user text-lg text-gray-400"></i>
                <span class="font-medium">Pemilik Toko</span>
                <i class="fa-solid fa-chevron-down text-xs"></i>
            </div>
            <div class="text-gray-400 text-xs border-l border-gray-700 pl-4 flex items-center gap-2">
                <i class="fa-regular fa-calendar"></i>
                <span>30 Nov 2025 14:35:10</span>
            </div>
            <a href="#" class="text-red-400 hover:text-red-300 transition flex items-center gap-1.5 text-xs font-semibold">
                <i class="fa-solid fa-right-from-bracket"></i>
                Keluar
            </a>
        </div>
    </header>

    <!-- WRAPPER UTAMA -->
    <div class="flex flex-1 overflow-hidden">
        
        <!-- SIDEBAR -->
        <aside class="w-60 bg-stone-900 text-gray-300 flex flex-col justify-between shrink-0 border-t border-stone-800">
            <nav class="p-4 space-y-1">
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm hover:bg-stone-800 transition">
                    <i class="fa-solid fa-chart-pie w-5 text-gray-400"></i> Dashboard
                </a>
                <a href="#" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm bg-stone-850 text-white font-medium border-l-4 border-amber-500 hover:bg-stone-800 transition">
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-boxes-stacked w-5 text-amber-500"></i> Data Produk
                    </span>
                    <i class="fa-solid fa-chevron-right text-[10px] text-gray-500"></i>
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm hover:bg-stone-800 transition">
                    <i class="fa-solid fa-tags w-5 text-gray-400"></i> Kategori
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm hover:bg-stone-800 transition">
                    <i class="fa-solid fa-receipt w-5 text-gray-400"></i> Transaksi
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm hover:bg-stone-800 transition">
                    <i class="fa-solid fa-file-invoice-dollar w-5 text-gray-400"></i> Laporan
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm hover:bg-stone-800 transition">
                    <i class="fa-solid fa-gear w-5 text-gray-400"></i> Pengaturan
                </a>
            </nav>
            <div class="p-4 border-t border-stone-800">
                <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs text-gray-400 hover:text-white hover:bg-stone-850 transition">
                    <i class="fa-solid fa-circle-info"></i> Tentang Aplikasi
                </a>
            </div>
        </aside>

        <!-- KONTEN -->
        <main class="flex-1 p-6 flex flex-col overflow-y-auto">
            
            <!-- TITLE & BUTTON -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Manajemen Produk dan Harga</h2>
                    <p class="text-xs text-gray-500 mt-1">Kelola daftar produk, stok, dan harga jual secara terpusat</p>
                </div>
                <button class="bg-stone-900 hover:bg-stone-850 text-white text-sm font-semibold px-4 py-2.5 rounded-lg shadow transition flex items-center gap-2">
                    <i class="fa-solid fa-plus text-xs"></i> Tambah Produk Baru
                </button>
            </div>

            <!-- SEARCH & FILTER BAR -->
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm mb-6">
                <form action="" method="GET" class="flex flex-wrap items-center gap-3">
                    
                    <!-- Search -->
                    <div class="flex-1 min-w-[260px] relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-3.5 text-gray-400 text-sm"></i>
                        <input type="text" name="q" placeholder="Cari produk... (Nama atau Kode)" 
                               value="<?= htmlspecialchars($search) ?>" 
                               class="w-full bg-gray-50 border border-gray-300 rounded-lg pl-9 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition">
                    </div>

                    <!-- Filter Kategori -->
                    <select name="kategori" class="bg-gray-50 border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 transition min-w-[150px]">
                        <option value="Semua Kategori">Semua Kategori</option>
                        <?php foreach($kategori_list as $kat): ?>
                            <option value="<?= $kat ?>" <?= $filter_kategori === $kat ? 'selected' : '' ?>><?= $kat ?></option>
                        <?php endforeach; ?>
                    </select>

                    <!-- Filter Status -->
                    <select name="status" class="bg-gray-50 border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 transition min-w-[140px]">
                        <option value="Semua Status" <?= $filter_status === 'Semua Status' ? 'selected' : '' ?>>Semua Status</option>
                        <option value="Aktif" <?= $filter_status === 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                        <option value="Nonaktif" <?= $filter_status === 'Nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                    </select>

                    <!-- Buttons -->
                    <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-stone-900 font-semibold text-sm px-4 py-2.5 rounded-lg transition shadow-sm">
                        Cari
                    </button>
                    <a href="manajemen_produk.php" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-sm px-4 py-2.5 rounded-lg transition border border-gray-300 flex items-center gap-1.5">
                        <i class="fa-solid fa-rotate-right text-xs"></i> Reset
                    </a>

                </form>
            </div>

            <!-- DAFTAR TABEL PRODUK -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm flex-1 flex flex-col justify-between overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-600 text-[11px] font-bold uppercase tracking-wider border-b border-gray-200">
                                <th class="py-3 px-4 w-12 text-center">No</th>
                                <th class="py-3 px-4">Kode Produk</th>
                                <th class="py-3 px-4">Nama Produk</th>
                                <th class="py-3 px-4">Kategori</th>
                                <th class="py-3 px-4 text-right">Harga Modal</th>
                                <th class="py-3 px-4 text-right">Harga Jual</th>
                                <th class="py-3 px-4 text-center">Stok Tersedia</th>
                                <th class="py-3 px-4 text-center">Status Aktif</th>
                                <th class="py-3 px-4 text-center w-40">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-150 text-sm text-gray-700">
                            <?php if (count($produk_tampil) > 0): ?>
                                <?php $no = 1; foreach ($produk_tampil as $p): ?>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="py-3.5 px-4 text-center font-medium text-gray-400"><?= $no++ ?></td>
                                        <td class="py-3.5 px-4 font-mono text-xs font-semibold text-gray-600"><?= $p['kode'] ?></td>
                                        <td class="py-3.5 px-4 font-semibold text-gray-900"><?= $p['nama'] ?></td>
                                        <td class="py-3.5 px-4">
                                            <span class="bg-stone-100 text-stone-700 text-xs px-2 py-0.5 rounded-md font-medium border border-stone-200"><?= $p['kategori'] ?></span>
                                        </td>
                                        <td class="py-3.5 px-4 text-right font-medium text-gray-600">Rp<?= number_format($p['harga_modal'], 0, ',', '.') ?></td>
                                        <td class="py-3.5 px-4 text-right font-bold text-gray-900">Rp<?= number_format($p['harga_jual'], 0, ',', '.') ?></td>
                                        <td class="py-3.5 px-4 text-center font-semibold <?= $p['stok'] <= 15 ? 'text-amber-600' : 'text-gray-900' ?>">
                                            <?= $p['stok'] ?>
                                        </td>
                                        <td class="py-3.5 px-4 text-center">
                                            <?php if ($p['status'] === 'Aktif'): ?>
                                                <span class="inline-flex items-center gap-1.5 bg-green-100 text-green-700 text-xs px-2.5 py-1 rounded-full font-bold">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> Aktif
                                                </span>
                                            <?php else: ?>
                                                <span class="inline-flex items-center gap-1.5 bg-gray-100 text-gray-500 text-xs px-2.5 py-1 rounded-full font-bold">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Nonaktif
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="py-3.5 px-4">
                                            <div class="flex items-center justify-center gap-1.5">
                                                <button class="border border-gray-300 hover:border-amber-500 hover:text-amber-500 text-gray-600 px-3 py-1.5 rounded text-xs font-medium transition flex items-center gap-1">
                                                    <i class="fa-regular fa-pen-to-square"></i> Ubah
                                                </button>
                                                <button class="border border-gray-300 hover:border-red-500 hover:text-red-500 text-gray-600 px-3 py-1.5 rounded text-xs font-medium transition flex items-center gap-1">
                                                    <i class="fa-regular fa-trash-can"></i> Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="9" class="text-center py-12 text-gray-400">
                                        <i class="fa-solid fa-box-open text-3xl mb-2 block"></i>
                                        Data produk tidak ditemukan.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- FOOTER / PAGINATION -->
                <div class="bg-gray-50 border-t border-gray-200 px-6 py-4 flex items-center justify-between text-xs text-gray-500 shrink-0">
                    <div>
                        Menampilkan <span class="font-bold text-gray-700">1 - <?= count($produk_tampil) ?></span> dari <span class="font-bold text-gray-700"><?= count($produk_tampil) ?></span> data
                    </div>
                    <div class="flex items-center gap-1">
                        <button class="p-1 px-2.5 border border-gray-300 bg-white rounded hover:bg-gray-50 transition" disabled>
                            <i class="fa-solid fa-chevron-left text-[10px]"></i>
                        </button>
                        <button class="bg-stone-900 text-white font-bold p-1 px-3 rounded shadow-sm">1</button>
                        <button class="p-1 px-2.5 border border-gray-300 bg-white rounded hover:bg-gray-50 transition" disabled>
                            <i class="fa-solid fa-chevron-right text-[10px]"></i>
                        </button>
                    </div>
                </div>
            </div>

        </main>
    </div>

</body>
</html>