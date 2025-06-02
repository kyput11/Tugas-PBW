<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Toko Buku Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">📚 Toko Buku Online</h1>
            <div class="space-x-4">
                <a href="index.php" class="hover:underline">Daftar Buku</a>
                <a href="tambah.php" class="hover:underline">Tambah Buku</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-4">Daftar Buku</h2>

        <form method="GET" class="flex flex-wrap gap-2 mb-4">
            <input type="text" name="judul" placeholder="Cari judul buku"
                   value="<?= $_GET['judul'] ?? '' ?>"
                   class="p-2 border rounded w-full md:w-1/3">
            <input type="text" name="tahun" placeholder="Cari tahun terbit"
                   value="<?= $_GET['tahun'] ?? '' ?>"
                   class="p-2 border rounded w-full md:w-1/3">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Cari</button>
            <a href="index.php" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Reset</a>
        </form>

        <table class="w-full bg-white rounded shadow overflow-hidden">
            <thead class="bg-gray-200 text-left">
                <tr>
                    <th class="p-3">ID</th>
                    <th class="p-3">Judul</th>
                    <th class="p-3">Penulis</th>
                    <th class="p-3">Tahun</th>
                    <th class="p-3">Harga</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM buku WHERE 1=1";
                if (!empty($_GET['judul'])) {
                    $judul = $koneksi->real_escape_string($_GET['judul']);
                    $query .= " AND judul LIKE '%$judul%'";
                }
                if (!empty($_GET['tahun'])) {
                    $tahun = intval($_GET['tahun']);
                    $query .= " AND tahun_terbit = $tahun";
                }

                $result = $koneksi->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='border-t hover:bg-gray-50'>
                        <td class='p-3'>{$row['id']}</td>
                        <td class='p-3'>{$row['judul']}</td>
                        <td class='p-3'>{$row['penulis']}</td>
                        <td class='p-3'>{$row['tahun_terbit']}</td>
                        <td class='p-3'>Rp" . number_format($row['harga'], 2, ',', '.') . "</td>
                        <td class='p-3 text-center'>
                            <a href='edit.php?id={$row['id']}' class='bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded'>Edit</a>
                            <a href='hapus.php?id={$row['id']}' onclick='return confirm(\"Hapus data?\")' class='bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded'>Hapus</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>
