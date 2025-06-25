<?php include 'db.php'; ?>
<?php
$id = $_GET['id'];
$buku = $conn->query("SELECT * FROM buku WHERE ID=$id")->fetch_assoc();

if ($_POST) {
    $stmt = $conn->prepare("UPDATE buku SET Judul=?, Penulis=?, Tahun_Terbit=?, Harga=?, stok=? WHERE ID=?");
    $stmt->bind_param("ssidii", $_POST['judul'], $_POST['penulis'], $_POST['tahun'], $_POST['harga'], $_POST['stok'], $id);
    $stmt->execute();
    header("Location: index.php");
}
?>
<form method="POST">
    <h2>Edit Buku</h2>
    Judul: <input type="text" name="judul" value="<?= $buku['Judul'] ?>"><br>
    Penulis: <input type="text" name="penulis" value="<?= $buku['Penulis'] ?>"><br>
    Tahun Terbit: <input type="number" name="tahun" value="<?= $buku['Tahun_Terbit'] ?>"><br>
    Harga: <input type="number" name="harga" value="<?= $buku['Harga'] ?>"><br>
    Stok: <input type="number" name="stok" value="<?= $buku['stok'] ?>"><br>
    <button type="submit">Update</button>
</form>
<?php include 'db.php'; ?>

<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    die("ID buku tidak valid.");
}

// Ambil data buku berdasarkan ID
$buku = $conn->query("SELECT * FROM buku WHERE ID=$id")->fetch_assoc();

if (!$buku) {
    die("Buku tidak ditemukan.");
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil input dan trim spasi
    $judul = trim($_POST['judul'] ?? '');
    $penulis = trim($_POST['penulis'] ?? '');
    $tahun = (int)($_POST['tahun'] ?? 0);
    $harga = (float)($_POST['harga'] ?? 0);
    $stok = (int)($_POST['stok'] ?? 0);

    // Validasi input sederhana
    if (empty($judul)) {
        $errors[] = "Judul wajib diisi.";
    }
    if (empty($penulis)) {
        $errors[] = "Penulis wajib diisi.";
    }
    if ($tahun <= 0) {
        $errors[] = "Tahun terbit tidak valid.";
    }
    if ($harga <= 0) {
        $errors[] = "Harga harus lebih dari 0.";
    }
    if ($stok < 0) {
        $errors[] = "Stok tidak boleh negatif.";
    }

    // Jika tidak ada error, update data
    if (empty($errors)) {
        $stmt = $conn->prepare("UPDATE buku SET Judul=?, Penulis=?, Tahun_Terbit=?, Harga=?, stok=? WHERE ID=?");
        $stmt->bind_param("ssidii", $judul, $penulis, $tahun, $harga, $stok, $id);
        $stmt->execute();

        header("Location: index.php");
        exit;
    }
}
?>

<h2>Edit Buku</h2>

<?php if (!empty($errors)): ?>
    <ul style="color: red;">
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="POST">
    Judul: <input type="text" name="judul" value="<?= htmlspecialchars($buku['Judul']) ?>"><br>
    Penulis: <input type="text" name="penulis" value="<?= htmlspecialchars($buku['Penulis']) ?>"><br>
    Tahun Terbit: <input type="number" name="tahun" value="<?= htmlspecialchars($buku['Tahun_Terbit']) ?>"><br>
    Harga: <input type="number" step="0.01" name="harga" value="<?= htmlspecialchars($buku['Harga']) ?>"><br>
    Stok: <input type="number" name="stok" value="<?= htmlspecialchars($buku['stok']) ?>"><br>
    <button type="submit">Update</button>
</form>
