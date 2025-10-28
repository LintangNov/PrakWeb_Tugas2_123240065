<?php
    require_once(__DIR__."/connection.php");
    if (!$koneksi) {
        die("Koneksi terputus: ". mysqli_connect_error());
    }

    $judul = $_POST['judul'];
    $genre = $_POST['genre'];
    $sutradara = $_POST['sutradara'];
    $tahun = (int)($_POST['tahun'] ?? 0);

    $sql = "INSERT INTO film (judul,genre,sutradara,tahun) VALUES (?,?,?,?)";
    $statement = $koneksi->prepare($sql);
    $statement->bind_param("sssi", $judul, $genre,$sutradara,$tahun);
    if ($statement->execute()) {
        echo "<script>alert('Data berhasil disimpan!'); window.location='index.php';</script>";
        header("location: index.php");
    } else {
        echo "<script>alert('Data gagal ditambahkan!'); window.location='index.php';</script>";
    }

    $statement->close();
    $koneksi->close();
?>