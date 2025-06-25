<?php
    $conn = new mysqli('localhost','root','', 'pemograman_web_buku');
    if ($conn->connect_error) {
        die( "$conn->connect_error):"  . $conn->connect_error);
    }
?>