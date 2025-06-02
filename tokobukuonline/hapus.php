<?php
include 'koneksi.php';
$id = $_GET['id'];
$koneksi->query("DELETE FROM buku WHERE id=$id");
header("Location: index.php");
?>

