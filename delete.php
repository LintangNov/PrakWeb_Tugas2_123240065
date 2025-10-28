<?php
    require_once(__DIR__."/connection.php");

    $id = (int) $_GET['id'];

    $sql = "DELETE FROM film WHERE id = ?";
    $statement = $koneksi->prepare($sql);
    $statement->bind_param("i", $id);
    $statement->execute();
    $statement->close();

    header("location: index.php");
?>