<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/exercise.php';
include_once '../objects/profile_exercise.php';
 
// instantiate database and category object
$database = new Database();
$db = $database->getConnection();

// initialize object
$exercise = new Exercise($db);
// $profile = new Profile($db);

$profile_id = (int) $_GET['id'];
$exercise->profile_id=$profile_id;


if(isset($_GET['exercise_id']) ){
    $profile_exercise = new ExerciseProfile($db);
	$profile_exercise->profile_id = $profile_id;
	$profile_exercise->exercise_id = (int) $_GET['exercise_id'];
    $profile_exercise->create();
}

if(isset($_GET['done_id']) ){
    $profile_exercise = new ExerciseProfile($db);
	$profile_exercise->id = (int) $_GET['done_id'];
    $profile_exercise->is_done = 1;
    $profile_exercise->update();
}

if(isset($_GET['del']) ){
    $profile_exercise = new ExerciseProfile($db);
	$profile_exercise->id = (int) $_GET['del'];
    $profile_exercise->delete();
}

if(isset($_GET['reset']) ){
    $profile_exercise = new ExerciseProfile($db);
	$profile_exercise->profile_id = $profile_id;
    $profile_exercise->is_done = 0;
    $profile_exercise->reset();
}

$stmt = $exercise->findAllByProfile();
$num = $stmt->rowCount();
?>

<!doctype html>
<html lang=en>
<head>
	<meta charset=utf-8>
	<meta name=viewport content="width=device-width,initial-scale=1">	
	<title>Zakupy</title>
	
	<link rel="stylesheet" href="../vendor/bootstrap.min.css">
	<script src="../vendor/jquery.min.js"></script>
	<script src="../vendor/bootstrap.min.js"></script>
	
	<link rel=stylesheet href="../vendor/landing.css">
<head>
<body>
    <nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">Workout</a>
        </div>
    </div>
    </nav>

    <div class="panel-body">	
        
        <a href="/profile/?reset=true&id=<?php echo $profile_id; ?>" class="btn btn-primary btn-lg btn-block" role="button">Reset wyników</a>	
        <table class="table table-hover">
                <thead>
                    <tr>
                        <th></th>
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
						<a href="?id='.$profile_id.'&del='.$row['id'].'" data-id="'.$row['name'].'" role="button">
							<img class="img-responsive center-block" style="width: 32px;" src="../vendor/delete-icon.png" alt="usun">
						</a></td>
					<td><a href="./?id='.$profile_id.'&done_id='.$row['id'].'" >'.$row['name']. ' ->' . $row['is_done'] .'</a></td>
					
				</tr>';
		}
	}
	?>	
            </tbody>
        </table> 

        
        <a href="/profile/add_exercise.php?id=<?php echo $profile_id;?>" class="btn btn-primary btn-lg btn-block" role="button">Dodaj ćwiczenie</a>	
    </div>

    <footer class="container-fluid text-center">
        <p>2022 e-Strix Kamil Mucik</p>
    </footer>
</body>
</html>