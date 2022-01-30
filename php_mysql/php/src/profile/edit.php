<?php
// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/profile.php';

$page_title = "Workout: Edytuj Profil";

// instantiate database and category object
$database = new Database();
$db = $database->getConnection();

// initialize object
$profile = new Profile($db);

$profile_id = (int) $_GET['id'];
$profile->id=$profile_id;

$profile->readOne();
?>
<!doctype html>
<html lang=en>
  <head>
    <meta charset=utf-8>
    <meta name=viewport content="width=device-width,initial-scale=1">	
    <title><?php echo $page_title; ?></title>
    
    <link rel="stylesheet" href="../vendor/bootstrap.min.css">
    <script src="../vendor/jquery.min.js"></script>
    <script src="../vendor/bootstrap.min.js"></script>
    
    <link rel=stylesheet href="../vendor/landing.css">
  <head>
  <body>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
          <div class="navbar-header">
              <a class="navbar-brand" href="<?php echo $home_url; ?>"><?php echo $page_title; ?></a>
          </div>
      </div>
    </nav>

    <div class="panel-body">

      <form action="<?php echo $home_url; ?>index.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" class="form-control" id="id" value="<?php echo $profile->id ?>">
        <div class="form-group">
          <label for="name">Nazwa:</label>
          <input type="name" name="name" class="form-control" id="name" value="<?php echo $profile->name ?>">
        </div>

        <button type="submit" name="formSubmit" class="btn btn-primary btn-lg btn-block">Zapisz</button>
      </form> 
    </div>
    <footer class="container-fluid text-center">
        <p>2022 e-Strix Kamil Mucik</p>
    </footer>
  </body>
</html>