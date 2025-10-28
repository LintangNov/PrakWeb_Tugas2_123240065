<?php
    require_once(__DIR__."/connection.php");

    $id = (int) $_POST['id'];
    $judul = $_POST['judul'];
    $genre = $_POST['genre'];
    $sutradara = $_POST['sutradara'];
    $tahun = (int)($_POST['tahun'] ?? 0);

    $sql = "UPDATE film SET judul = ?, genre = ?, tahun = ?, sutradara = ? WHERE id = ?";
    $statement = $koneksi->prepare($sql);
    $statement->bind_param("ssisi", $judul, $genre, $tahun, $sutradara, $id);

    if ($statement->execute()) {
        header("location: index.php");
    }

?>