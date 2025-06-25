<?php include 'db.php'; ?>
<?php
if ($_POST) {
    $stmt = $conn->prepare("INSERT INTO buku (Judul, Penulis, Tahun_Terbit, Harga, stok) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssidi", $_POST['judul'], $_POST['penulis'], $_POST['tahun'], $_POST['harga'], $_POST['stok']);
    $stmt->execute();
    header("Location: index.php");
}
?>
<form method="POST">
    <h2>Tambah Buku</h2>
    Judul: <input type="text" name="judul"><br>
    Penulis: <input type="text" name="penulis"><br>
    Tahun Terbit: <input type="number" name="tahun"><br>
    Harga: <input type="number" name="harga" step="0.01"><br>
    Stok: <input type="number" name="stok"><br>
    <button type="submit">Simpan</button>
</form>
