<?php
    
    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "film";
    $koneksi = null;
    $port = "8111";

    try {
        $koneksi = new mysqli(hostname: $host, username: $user, password: $pass, database: $database, port: $port);
    } catch (Exception $e) {
        echo "Koneksi gagal: $e";
    }
?>