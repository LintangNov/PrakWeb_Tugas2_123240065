<?php
  require_once(__DIR__."/connection.php");
  if (!$koneksi) {
        die("Koneksi terputus: ". mysqli_connect_error());
    }

  $id = (int)$_GET['id'];

  $sql = "SELECT * FROM film WHERE id = ?";
  $statement = $koneksi->prepare($sql);
  $statement->bind_param("i",$id);
  $statement ->execute();
  $hasil = $statement->get_result();
  $film = $hasil->fetch_assoc();
  $statement->close();

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
<body style="background-color: darkseagreen">
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
            <a class="nav-link  text-light" href="#">Edit Film</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container d-flex justify-content-center">
    <div class="card m-5 text-center" style="width: 900px; box-shadow: 20%;; border-radius: 12px;">
      <div class="card-body m-4">
        <h1 class="my-4">Edit Film</h1>
        <form action="update.php" method="post" class="mt-4 text-start">
          <input type="hidden" name="id" value="<?= htmlspecialchars($film['id']) ?>">
        <div class="mb-3">
          <label class="form-label">Judul Film</label>
          <input value="<?= htmlspecialchars($film['judul']) ?>" type="text" name="judul" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Genre</label>
          <select name="genre" class="form-select" required>
            <?php
              $gen = htmlspecialchars($film["genre"]);
              echo "<option value='" . htmlspecialchars($gen) . "' $selected>$gen</option>";
            ?>
         
          <?php
            $genres = ['Romance', 'Action', 'Horror', 'Comedy'];
            foreach ($genres as $g) {
                $selected = ($g === $film['genre']) ? 'selected' : '';
                echo "<option value='" . htmlspecialchars($g) . "' $selected>$g</option>";
            }
          ?>
        </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Sutradara</label>
          <input value="<?= htmlspecialchars($film['sutradara']) ?>" placeholder="Sutradara" type="text" name="sutradara" class="form-control" required>
        </div>
  
        <div class="mb-3">
          <label class="form-label">Tahun Rilis</label>
          <input value="<?= htmlspecialchars($film['tahun']) ?>" placeholder="Tahun Rilis" type="number" name="tahun" class="form-control" min="1888" max="2025" required>
        </div>
  
        <div class="d-flex justify-content-center">
          <button type="submit" class="btn btn-success text-dark" style="width: 100%; font-weight: bold;">Update</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</body>
</html>