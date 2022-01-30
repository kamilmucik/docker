<?php

// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../shared/utilities.php';
include_once '../objects/exercise.php';
 
// instantiate database and category object
$database = new Database();
$db = $database->getConnection();

$utilities = new Utilities();
// initialize object
$exercise = new Exercise($db);

if(isset($_POST['formSubmit']) ){

    $image_base64 = "";
    if(isset($_POST['image_base64']) ){
        $image_base64 = $_POST['image_base64'];
    }
    
    if(isset($_FILES['fileToUpload']) ){
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        // Check if file already exists
        if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";

            $img = file_get_contents($target_file);
            // Encode the image string data into base64
            $image_base64 = base64_encode($img);

            unlink($target_file);
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }
    }

	$exercise->name = $_POST['name'];
	$exercise->description = $_POST['description'];
	$exercise->image_base64 = $image_base64;
	
	if (isset($_POST['id'])){
		$exercise->id = $_POST['id'];
		$exercise->update();
	} else {
		$exercise->create();
	}
}

if(isset($_GET['del']) ){
	$exercise->id = (int) $_GET['del'];
    $exercise->delete();
}

// query
$stmt = $exercise->readPaging($from_record_num, $records_per_page);
// $stmt = $exercise->readAll();
$num = $stmt->rowCount();
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
        <a href="<?php echo $home_url; ?>exercise/add.php" class="btn btn-primary btn-lg btn-block" role="button">Dodaj</a>	
        <table class="table table-hover exercise_table">
            <thead>
                <tr>
                    <th></th>
                    <th>Nazwa</th>
                </tr>
            </thead>
            <tbody>
            <?php
	if($num>0){
	
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			
			echo '<tr>
					<td>
						<a href="#" data-href="'.$home_url.'exercise/?del='.$row['id'].'"  data-id="'.$row['name'].'" data-toggle="modal" data-target="#confirm-delete" role="button">
							<img class="delete_img" class="img-responsive center-block" style="width: 32px;" src="../vendor/delete-icon.png" alt="usun">
						</a></td>
					<td>
                        <a href="'.$home_url.'exercise/edit.php?id='.$row['id'].'" >
                            <div class="exercise_block">
                                <div class="exercise_image"><img src="data:image/png;base64,'.$row['image_base64'].'"></div>
                                <div class="exercise_name">'.$row['name'].'</div>
                                <div class="exercise_desc">'.$row['description'].'</div>
                            </div>
                        </a>
                    </td>
				</tr>';
		}
	}
	?>	
            </tbody>
        </table>   
<?php
// include paging
    $total_rows=$exercise->count();
    $page_url="{$home_url}exercise/index.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
?>
    <table style="width: 100%">
        <tbody>
            <tr>
                <td>
                    <a href="<?php echo $paging['previous'] ?>" class="btn btn-primary btn-lg btn-block" role="button">Poprzednia</a>
                </td>
                <td style="text-align: center;">
                    <?php echo $page; ?> z <?php echo $paging['total_pages'] ?>
                </td>
                <td>
                    <a href="<?php echo $paging['next'] ?>" class="btn btn-primary btn-lg btn-block" role="button">Następna</a>
                </td>
            </tr>
        </tbody>
    </table>

    </div>




<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Usuwam
            </div>
            <div class="modal-body">
                <p class="debug-url"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
                <a class="btn btn-danger btn-ok">Usuń</a>
            </div>
        </div>
    </div>
</div>

 <script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

        $('.debug-url').html('Wybrano: <strong>' + $(e.relatedTarget).data('id') + '</strong>');
    });
</script>



    <footer class="container-fluid text-center">
        <p>2022 e-Strix Kamil Mucik</p>
    </footer>
</body>
</html>