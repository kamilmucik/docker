<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/exercise.php';
 
// instantiate database and category object
$database = new Database();
$db = $database->getConnection();

// initialize object
$exercise = new Exercise($db);

if(isset($_POST['formSubmit']) ){
	$exercise->name = $_POST['name'];
	$exercise->description = $_POST['description'];
	$exercise->image_base64 = $_POST['image_base64'];
	
	if (isset($_POST['id'])){
		$exercise->id = $_POST['id'];
		$exercise->update();
	} else {
		$exercise->create();
	}
}

// query 
$stmt = $exercise->readAll();
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
            <a class="navbar-brand" href="/">Workout: Ćwiczenia</a>
        </div>
    </div>
    </nav>

    <div class="panel-body">
        <a href="/exercise/add.php" class="btn btn-primary btn-lg btn-block" role="button">Dodaj</a>	
        <table class="table table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Nazwa</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
	if($num>0){
	
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			
			echo '<tr>
					<td>
						<a href="#" data-href="?del='.$row['id'].'"  data-id="'.$row['name'].'" data-toggle="modal" data-target="#confirm-delete" role="button">
							<img class="img-responsive center-block" style="width: 32px;" src="../vendor/delete-icon.png" alt="usun">
						</a></td>
					<td><a href="./edit.php?id='.$row['id'].'" >'.$row['name'].'</a></td>
					<td>
						<a href="./lista/?id='.$row['id'].'" role="button">
							<img class="img-responsive center-block" style="width: 32px;" src="../vendor/edit-icon.png" alt="zobacz">
						</a>
					</td>
				</tr>';
		}
	}
	?>	
            </tbody>
        </table>   


    </div>

    <footer class="container-fluid text-center">
        <p>2022 e-Strix Kamil Mucik</p>
    </footer>
</body>
</html>