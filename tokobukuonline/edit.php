<?php include 'koneksi.php';
$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun = $_POST['tahun'];
    $harga = $_POST['harga'];

    $stmt = $koneksi->prepare("UPDATE buku SET judul=?, penulis=?, tahun_terbit=?, harga=? WHERE id=?");
    $stmt->bind_param("sssdi", $judul, $penulis, $tahun, $harga, $id);
    $stmt->execute();
    header("Location: index.php");
}

$result = $koneksi->query("SELECT * FROM buku WHERE id=$id");
$row = $result->fetch_assoc();
?>
<h2>Edit Buku</h2>
<form method="post">
    Judul: <input type="text" name="judul" value="<?= $row['judul'] ?>" required><br>
    Penulis: <input type="text" name="penulis" value="<?= $row['penulis'] ?>" required><br>
    Tahun Terbit: <input type="text" name="tahun" value="<?= $row['tahun_terbit'] ?>" required><br>
    Harga: <input type="text" name="harga" value="<?= $row['harga'] ?>" required><br>
    <button type="submit">Update</button>
</form>
