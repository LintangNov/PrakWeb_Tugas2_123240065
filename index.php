<?php
  require_once(__DIR__ ."/connection.php");
    if (!$koneksi) {
        die("Koneksi terputus: ". mysqli_connect_error());
    }

  $sql = "SELECT * FROM film";
  $statement = $koneksi->prepare($sql);
  $statement ->execute();
  $hasil = $statement->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-success">
    <div class="container-fluid">
      <a class="navbar-brand  text-light" href="#">Manajemen Film</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active  text-light" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link  text-light" href="tambah.php">Tambah Film</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container mx-auto text-center my-5">
    <div class="row">
      <div class="col-8 text-start">
        <h2>Selamat Datang di Manajemen Film</h2>
        <p class="mt-2">Ini adalah daftar film anda.</p>
        <table class="table table-bordered table-light">
          <thead class="table table-info">
            <tr class="table table-info">
              <th>No</th>
              <th>Judul Film</th>
              <th>Genre</th>
              <th>Tahun Rilis</th>
              <th>Sutradara</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $no =1;
              while ($row = $hasil->fetch_assoc()) {
                echo"<tr>";
                echo"<td>$no</td>";
                echo"<td>". $row['judul'] ."</td>";
                echo"<td>". $row['genre'] ."</td>";
                echo"<td>". $row['tahun'] ."</td>";
                echo"<td>". $row['sutradara'] ."</td>";
                echo"<td>";
                echo'<div class="row p-2">
                        <a class="btn btn-sm btn-primary me-2" href="edit.php?id=' . $row['id'] . '">Edit</a>
                        <a class="btn btn-sm btn-danger" href="delete.php?id='.$row['id'].'" onclick="return confirm(\'Apakah kamu yakin ingin menghapus film ini?\');">Delete</a>
                    </div>';
                echo"</td>";
                echo"</tr>";
                $no++;
              }
              $statement->close();
            ?>
          </tbody>
        </table>
      </div>
      <div class="col-4">
        <img src="https://thumbs.dreamstime.com/b/mm-film-strip-rolls-black-gold-texture-cinematic-visual-presentation-nostalgic-movie-reel-concept-entertainment-creative-379368635.jpg" alt="" id="film-image">
      </div>
    </div>
  </div>
</body>

</html>