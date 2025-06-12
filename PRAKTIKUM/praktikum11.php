<!DOCTYPE html>
<html>
<head>
    <title>Program Navigasi PHP</title>
</head>
<body>
$hari = "Senin";


switch ($hari) {
   case "Senin":
       echo "Hari pertama kerja!";
       break;
   case "jum'at":
       echo "Solat jumat!";
       break;
   case "Minggu":
       echo "Libur akhir pekan!";
       break;
   default:
       echo "Hari biasa.";
   }
   for ($i = 1; $i <= 5; $i++) {
   echo "Angka ke-”.$i.”<br>";
}
$buah = ["Apel", "Jeruk", "Mangga"];
for ($i = 0; $i < count($buah); $i++) {
   echo $buah[$i] . "<br>";
   $nilai = 1;


while ($nilai <= 5) {
   echo "Nilai: ". $nilai ."<br>";
   $nilai++;
}
$mahasiswa = [
   "10001" => "Andi",
   "10002" => "Budi",
   "10003" => "Citra"
];
foreach ($mahasiswa as $nim => $nama) {
   echo "NIM: ". $nim .", Nama:". $nama."<br>";
}
$umur = 18;
$status = ($umur >= 17) ? "Dewasa" : "Anak-anak";


