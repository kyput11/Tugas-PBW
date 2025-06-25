<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "pemrograman_web_contoh";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
<?php
// File: db.php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "pemrograman_web_contoh";
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

<!-- File: index.php -->
<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Buku</title>
</head>
<body>
    <h2>Daftar Buku</h2>
    <a href="tambah_buku.php">Tambah Buku</a> | <a href="pelanggan.php">Kelola Pengguna</a> | <a href="buat_pesanan.php">Buat Pesanan</a> | <a href="lihat_pesanan.php">Lihat Pesanan</a>
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

<!-- File: pelanggan.php -->
<?php include 'db.php'; ?>
<?php
if ($_POST) {
    $stmt = $conn->prepare("INSERT INTO pelanggan (Nama, Alamat, Email, Telepon) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $_POST['nama'], $_POST['alamat'], $_POST['email'], $_POST['telepon']);
    $stmt->execute();
}
?>
<h2>Daftar Pelanggan</h2>
<form method="POST">
    Nama: <input type="text" name="nama" required><br>
    Alamat: <input type="text" name="alamat"><br>
    Email: <input type="email" name="email"><br>
    Telepon: <input type="text" name="telepon"><br>
    <button type="submit">Tambah</button>
</form>
<table border="1" cellpadding="10">
    <tr><th>ID</th><th>Nama</th><th>Alamat</th><th>Email</th><th>Telepon</th></tr>
    <?php
    $result = $conn->query("SELECT * FROM pelanggan");
    while ($row = $result->fetch_assoc()):
    ?>
    <tr>
        <td><?= $row['ID'] ?></td>
        <td><?= $row['Nama'] ?></td>
        <td><?= $row['Alamat'] ?></td>
        <td><?= $row['Email'] ?></td>
        <td><?= $row['Telepon'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<!-- File: buat_pesanan.php -->
<?php include 'db.php'; ?>
<?php
if ($_POST) {
    $pelanggan_id = $_POST['pelanggan_id'];
    $tanggal = date('Y-m-d');
    $total = 0;

    $conn->query("INSERT INTO pesanan (Tanggal_Pesanan, Pelanggan_ID, Total_Harga) VALUES ('$tanggal', $pelanggan_id, 0)");
    $pesanan_id = $conn->insert_id;

    foreach ($_POST['buku'] as $buku_id => $qty) {
        if ($qty > 0) {
            $b = $conn->query("SELECT Harga FROM buku WHERE ID=$buku_id")->fetch_assoc();
            $harga = $b['Harga'];
            $subtotal = $harga * $qty;
            $total += $subtotal;
            $conn->query("INSERT INTO detail_pesanan VALUES ($pesanan_id, $buku_id, $qty, $harga)");
        }
    }
    $conn->query("UPDATE pesanan SET Total_Harga=$total WHERE ID=$pesanan_id");
    echo "<p>Pesanan berhasil dibuat.</p>";
}
?>
<h2>Buat Pesanan</h2>
<form method="POST">
    Pilih Pelanggan:
    <select name="pelanggan_id">
        <?php
        $res = $conn->query("SELECT * FROM pelanggan");
        while ($r = $res->fetch_assoc()) {
            echo "<option value='{$r['ID']}'>{$r['Nama']}</option>";
        }
        ?>
    </select><br>
    <h3>Daftar Buku</h3>
    <?php
    $res = $conn->query("SELECT * FROM buku");
    while ($r = $res->fetch_assoc()) {
        echo "{$r['Judul']} (Rp{$r['Harga']}) Qty: <input type='number' name='buku[{$r['ID']}]' min='0' max='{$r['stok']}'><br>";
    }
    ?>
    <button type="submit">Simpan Pesanan</button>
</form>

<!-- File: lihat_pesanan.php -->
<?php include 'db.php'; ?>
<h2>Data Pesanan</h2>
<?php
$pesanan = $conn->query("SELECT p.*, pl.Nama FROM pesanan p JOIN pelanggan pl ON p.Pelanggan_ID = pl.ID ORDER BY p.ID DESC");
while ($row = $pesanan->fetch_assoc()):
?>
    <h3>Pesanan #<?= $row['ID'] ?> - <?= $row['Nama'] ?> (<?= $row['Tanggal_Pesanan'] ?>)</h3>
    <ul>
        <?php
        $d = $conn->query("SELECT dp.*, b.Judul FROM detail_pesanan dp JOIN buku b ON dp.Buku_ID = b.ID WHERE dp.Pesanan_ID = {$row['ID']}");
        while ($item = $d->fetch_assoc()):
        ?>
            <li><?= $item['Judul'] ?> - <?= $item['Kuantitas'] ?> x Rp<?= $item['Harga_Per_Satuan'] ?></li>
        <?php endwhile; ?>
    </ul>
    <strong>Total: Rp<?= number_format($row['Total_Harga'], 2, ',', '.') ?></strong>
    <hr>
<?php endwhile; ?>
