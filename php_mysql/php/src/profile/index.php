<?php

// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../shared/utilities.php';
include_once '../objects/exercise.php';
include_once '../objects/profile_exercise.php';
 
// instantiate database and category object
$database = new Database();
$db = $database->getConnection();

// initialize object
$exercise = new Exercise($db);
// $profile = new Profile($db);
$utilities = new Utilities();

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

$stmt = $exercise->readPagingByProfile($from_record_num, $records_per_page);
// $stmt = $exercise->findAllByProfile();
$num = $stmt->rowCount();
?>

<!doctype html>
<html lang=en>
<head>
	<meta charset=utf-8>
	<meta name=viewport content="width=device-width,initial-scale=1">	
	<title>Workout</title>
	
	<link rel="stylesheet" href="../vendor/bootstrap.min.css">
	<script src="../vendor/jquery.min.js"></script>
	<script src="../vendor/bootstrap.min.js"></script>
	
	<link rel=stylesheet href="../vendor/landing.css">
<head>
<body>
    <nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo $home_url; ?>">Workout</a>
        </div>
    </div>
    </nav>

    <div class="panel-body">	
        
        
        <table style="width: 100%">
            <tbody>
                <tr>
                    <td>
                    <a href="<?php echo $home_url; ?>profile/?reset=true&id=<?php echo $profile_id; ?>" class="btn btn-primary btn-lg btn-block" role="button">Reset wyników</a>
                    </td>
                    <td>
                        &nbsp;
                    </td>
                    <td>
                    <a href="<?php echo $home_url; ?>profile/add_exercise.php?id=<?php echo $profile_id;?>" class="btn btn-primary btn-lg btn-block" role="button">Dodaj ćwiczenie</a>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <table class="table table-hover exercise_table">
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
			
            $tr_class = $row['is_done'] == 0 ? "not_done" : "done";
			echo '<tr >
					<td class="'.$tr_class.'">
						<a class="delete_img" href="'.$home_url.'/profile/?id='.$profile_id.'&del='.$row['id'].'" data-id="'.$row['name'].'" role="button">
							<img class="img-responsive center-block" style="width: 32px;" src="../vendor/delete-icon.png" alt="usun">
						</a></td>
					<td>
                        <a href="'.$home_url.'profile/?id='.$profile_id.'&done_id='.$row['id'].'" >
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
    $total_rows=$exercise->countByProfile();

    $page_url="{$home_url}profile/index.php?id=". $profile_id . "&";
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

    <footer class="container-fluid text-center">
        <p>2022 e-Strix Kamil Mucik</p>
    </footer>
</body>
</html>