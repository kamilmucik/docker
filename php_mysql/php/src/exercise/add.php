<?php
// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/exercise.php';
 
?>
<!doctype html>
<html lang=en>
  <head>
    <meta charset=utf-8>
    <meta name=viewport content="width=device-width,initial-scale=1">	
    <title>Workout: Ćwiczenia</title>
    
    <link rel="stylesheet" href="../vendor/bootstrap.min.css">
    <script src="../vendor/jquery.min.js"></script>
    <script src="../vendor/bootstrap.min.js"></script>
    
    <link rel=stylesheet href="../vendor/landing.css">
  <head>
  <body>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
          <div class="navbar-header">
              <a class="navbar-brand" href="<?php echo $home_url; ?>">Workout: Ćwiczenia</a>
          </div>
      </div>
    </nav>

    <div class="panel-body">

      <form action="<?php echo $home_url; ?>exercise/index.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="name">Nazwa:</label>
          <input type="name" name="name" class="form-control" id="name" >
        </div>
        <div class="form-group">
          <label for="description">Opis:</label>
          <input type="text" name="description" class="form-control" id="description" >
        </div>
        <div class="form-group">
          <label for="image_base64">Obrazek(400x225):</label>
          <input type="file" name="fileToUpload" class="form-control" id="fileToUpload" >
        </div>

        <button type="submit" name="formSubmit" class="btn btn-primary btn-lg btn-block">Zapisz</button>
      </form> 
    </div>
    <footer class="container-fluid text-center">
        <p>2022 e-Strix Kamil Mucik</p>
    </footer>
  </body>
</html>