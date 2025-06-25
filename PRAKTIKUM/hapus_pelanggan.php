<?php
include("koneksi_db.php"); // Pastikan file ini ada dan benar

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Cek apakah ID tersebut ada
    $check = mysqli_query($conn, "SELECT * FROM pelanggan WHERE ID = $id");

    if (mysqli_num_rows($check) > 0) {
        // Hapus data
        $delete = mysqli_query($conn, "DELETE FROM pelanggan WHERE ID = $id");

        if ($delete) {
            header("Location: pelanggan.php");
            exit;
        } else {
            echo "Gagal menghapus data: " . mysqli_error($conn);
        }
    } else {
        echo "Pelanggan dengan ID $id tidak ditemukan.";
    }
} else {
    echo "ID tidak ditemukan di URL.";
}
?>
