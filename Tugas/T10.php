<!DOCTYPE html>
<html>
<head>
    <title>Latihan Nilai Mahasiswa</title>
</head>
<body>
    <h2>Form Nilai Mahasiswa</h2>
    <form method="post" action="">
        Nama: <input type="text" name="nama" required><br>
        Nilai: <input type="number" name="nilai" required><br>
        <input type="submit" value="Proses">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = $_POST['nama'];
        $nilai = $_POST['nilai'];
        $predikat = "";
        $status = "";

        if ($nilai >= 85) {
            $predikat = "A";
        } elseif ($nilai >= 70) {
            $predikat = "B";
        } elseif ($nilai >= 60) {
            $predikat = "C";
        } elseif ($nilai >= 50) {
            $predikat = "D";
        } else {
            $predikat = "E";
        }

        if ($nilai >= 60) {
            $status = "Lulus";
        } else {
            $status = "Tidak Lulus";
        }

        echo "<hr>";
        echo "Nama : $nama<br>";
        echo "Nilai : $nilai<br>";
        echo "Predikat : $predikat<br>";
        echo "Status : $status<br>";
    }
    ?>
</body>
</html>
