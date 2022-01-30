<?php
//phpinfo();
// include database and object files
include_once './config/core.php';
include_once './config/database.php';
include_once './objects/profile.php';
include_once './objects/profile_exercise.php';
 
// instantiate database and category object
$database = new Database();
$db = $database->getConnection();

// initialize object
$profile = new Profile($db);

if(isset($_GET['del']) ){
	$profile_exercise = new ExerciseProfile($db);
	$profile->id = (int) $_GET['del'];
	$profile->delete();
	$profile_exercise->profile_id = (int) $_GET['del'];
	$profile_exercise->deleteByProfile();
}

if(isset($_POST['formSubmit']) ){
	$profile->name = $_POST['name'];
	
	if (isset($_POST['id'])){
		$profile->id = $_POST['id'];
		$profile->update();
	} else {
		$profile->create();
	}
}


// query 
$stmt = $profile->readAll();
$num = $stmt->rowCount();
?>

<!doctype html>
<html lang=en>
<head>
	<meta charset=utf-8>
	<meta name=viewport content="width=device-width,initial-scale=1">	
	<title>Workout</title>
	
	<link rel="stylesheet" href="vendor/bootstrap.min.css">
	<script src="vendor/jquery.min.js"></script>
	<script src="vendor/bootstrap.min.js"></script>
	
	<link rel=stylesheet href="vendor/landing.css">
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
<a href="<?php echo $home_url; ?>profile/add.php" class="btn btn-primary btn-lg btn-block" role="button">Dodaj</a>	
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
						<a href="#" data-href="'.$home_url.'?del='.$row['id'].'"  data-id="'.$row['name'].'" data-toggle="modal" data-target="#confirm-delete" role="button">
							<img class="delete_img" class="img-responsive center-block" style="width: 32px;" src="vendor/delete-icon.png" alt="usun">
						</a></td>
					<td><a href="'.$home_url.'profile/?id='.$row['id'].'" >'.$row['name'].'</a></td>
					<td>
						<a href="'.$home_url.'profile/edit.php?id='.$row['id'].'" role="button">
							<img class="img-responsive center-block" style="width: 32px;" src="vendor/edit-icon.png" alt="zobacz">
						</a>
					</td>
				</tr>';
		}
	}
	?>				
	</tbody>
</table>

<a href="<?php echo $home_url; ?>exercise/" class="btn btn-primary btn-lg btn-block" role="button">Zarządzaj</a>	
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