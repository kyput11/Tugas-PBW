<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Toko Buku Online</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="logo">Toko Buku Online</div>
            <ul class="nav-links">
                <li><a href="#">Daftar Buku</a></li>
                <li><a href="#">Tambah Buku</a></li>
                <li><a href="#">Buat Pesanan</a></li>
                <li><a href="#">Lihat Pesanan</a></li>
                <li><a href="#">Hapus Buku</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1>Daftar Buku</h1>
        <form method="GET" class="search-form">
            <div>
                <label>Cari Berdasarkan Judul</label>
                <input type="text" name="judul" placeholder="Masukkan judul buku" value="<?= $_GET['judul'] ?? '' ?>">
            </div>
            <div>
                <label>Cari Berdasarkan Tahun Terbit</label>
                <input type="text" name="tahun" placeholder="Masukkan tahun terbit" value="<?= $_GET['tahun'] ?? '' ?>">
            </div>
            <div class="search-buttons">
                <button type="submit" class="btn-primary">Cari</button>
                <a href="index.php" class="btn-secondary">Reset</a>
            </div>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun Terbit</th>
                    <th>Harga</th>
                    <th></th>
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
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['judul']}</td>
                        <td>{$row['penulis']}</td>
                        <td>{$row['tahun_terbit']}</td>
                        <td>Rp" . number_format($row['harga'], 2, ',', '.') . "</td>
                        <td>
                            <a href='edit.php?id={$row['id']}' class='btn-edit'>Edit</a>
                            <a href='hapus.php?id={$row['id']}' class='btn-delete' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
