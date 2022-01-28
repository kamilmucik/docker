<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/exercise.php';
 
// instantiate database and category object
$database = new Database();
$db = $database->getConnection();

// initialize object
$exercise = new Exercise($db);

$profile_id = (int) $_GET['id'];

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
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Wybierz</th>
                </tr>
            </thead>
            <tbody>
            <?php
	if($num>0){
	
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			
			echo '<tr>
					<td><a href="./index.php?id='.$profile_id.'&exercise_id='.$row['id'].'" >'.$row['name'].'</a></td>
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