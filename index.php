<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Buku</title>
</head>
<body>
    <h2>Daftar Buku</h2>
    <a href="tambah_buku.php">Tambah Buku</a>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th><th>Judul</th><th>Penulis</th><th>Tahun</th><th>Harga</th><th>Stok</th><th>Aksi</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM buku");
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= $row['ID'] ?></td>
            <td><?= $row['Judul'] ?></td>
            <td><?= $row['Penulis'] ?></td>
            <td><?= $row['Tahun_Terbit'] ?></td>
            <td>Rp<?= number_format($row['Harga'], 2, ',', '.') ?></td>
            <td><?= $row['stok'] ?></td>
            <td>
                <a href="edit_buku.php?id=<?= $row['ID'] ?>">Edit</a>
                <a href="hapus_buku.php?id=<?= $row['ID'] ?>" onclick="return confirm('Yakin?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
