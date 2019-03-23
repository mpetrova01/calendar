<?php
$title = 'Update';
$db = mysqli_connect('localhost', 'root', '', 'todos') or die("QUERY failed" . mysqli_error($db));
$task_id = $_GET['id'];
$read_query = "SELECT title, description FROM tasks WHERE id = '$task_id'";
$result = mysqli_query($db, $read_query);
$row_tasks = mysqli_fetch_assoc($result);
$tasks_query = "SELECT * FROM tasks";
$tasks_result = mysqli_query($db, $tasks_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Update my task</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
   <div class="container">
	<div class="row justify-content-md-center">
		<h2>Update</h2>
	</div>
	<div class="row justify-content-md-center">			
		<div class="col-sm-10">			
			<form method="post" action="">
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" name="title" value="<?= $row_tasks['title'] ?>">
				</div>
				<div class="form-group">
					<label for="description">Description</label>
					<input type="text" class="form-control" id="description" name="description" value="<?= $row_tasks['description'] ?>">
				</div>
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-success">SAVE product</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php 
if(isset($_POST['submit'])){
		$titlee 			= $_POST['title'];
		$description 			= $_POST['description'];

		//to do add hidden field product id
		$title_update_query = "UPDATE tasks SET title=" .$titlee. ", ";
		$title_update_query .= " WHERE title_id = $task_id";
		$result_update = mysqli_query($db, $title_update_query);
		$description_update_query = "UPDATE tasks SET description='$description'";
		$description_update_query .= " WHERE title_id = $task_id";	
			//var_dump(description_update_query);
		$result = mysqli_query($db, $description_update_query);
		if($result){
		// echo "Success!";
			header('Location: index.php');
		} else {
			echo mysqli_error($db);
		// echo "Please, try again later!";
		}
	}
?>
</body>
</html>
