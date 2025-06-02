<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Tambah Buku</h2>
        <form method="post">
            <input type="text" name="judul" placeholder="Judul" required class="w-full p-2 border mb-2 rounded">
            <input type="text" name="penulis" placeholder="Penulis" required class="w-full p-2 border mb-2 rounded">
            <input type="text" name="tahun" placeholder="Tahun Terbit" required class="w-full p-2 border mb-2 rounded">
            <input type="text" name="harga" placeholder="Harga" required class="w-full p-2 border mb-4 rounded">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Simpan</button>
            <a href="index.php" class="ml-2 text-gray-700 hover:underline">Batal</a>
        </form>
    </div>
</body>
</html>
