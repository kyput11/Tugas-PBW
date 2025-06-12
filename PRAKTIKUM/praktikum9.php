<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        echo "Halo, selamat datang di dunia PHP!";
        $nama = "Budi";
        $umur = 20;

        echo "<br>";
        // Menampilkan nilai variabel
        echo "Nama: " . $nama . "<br>";
        echo "Umur: " . $umur . " tahun<br>";

        define("SITE_NAME", "unsika.ac.id");
        define("VERSION", "1.0");


        echo "Selamat datang di " . SITE_NAME . "<br>";
        echo "Versi Sistem: " . VERSION . "<br>";

        $buah = ["apel", "jeruk", "mangga"];
        echo $buah[1] . "<br>";

        class Mahasiswa {
            public $nama;
            public function sapa() {
                return "Halo, saya $this->nama";
            }
        }
        $mhs = new Mahasiswa();
        $mhs->nama = "Jeni";
        echo $mhs->sapa();
     
    ?>
</body>
</html>