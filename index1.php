<?php
session_start();
//echo $_SESSION['username'];
$read_query = "SELECT title, description, create_date, end_date FROM `tasks`";
if( isset($_GET['submit'])){
	
	if( $_GET['sort'] == 'title_asc'){
		$sort_by = 'pd.name';
		$sort_direction = 'ASC';
	} else if( $_GET['sort'] == 'title_desc' ) {
		$sort_by = 'pd.name';
		$sort_direction = 'DESC';
	} elseif ( $_GET['sort'] == 'description_asc' ) {
		$sort_by = 'm.name';
		$sort_direction = 'ASC';
	} elseif ( $_GET['sort'] == 'description_desc' ) {
		$sort_by = 'm.name';
		$sort_direction = 'DESC';
      }
	$limit = $_GET['limit'];
	$read_query .= " ORDER BY ({$sort_by}) {$sort_direction} LIMIT {$limit}";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>My tasks</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
  <div>
  	<h1>List with my tasks</h1>
  </div>
  <div class="row justify-content-md-center mb-2">
		<form action="" method="get">
			<div class="form-row">
				<div class="col-sm-5">
					<select class="custom-select" name="sort">
						<option value="title_asc">Sort by title A-Z</option>
						<option value="title_desc">Sort by title Z-A</option>
						<option value="description_asc">Sort by description A-Z</option>
						<option value="description_desc">Sort by description Z-A</option>
					</select>	
				</div>
				<div class="col-sm-5">
					<select class="custom-select" name="limit">
						<option value="2">2</option>
						<option value="5">5</option>
						<option value="10">10</option>
					</select>	
				</div>
				<div class="col-sm-2">
					<input type="submit" name="submit" class="btn btn-success" value="sort">
				</div>
			</div>
		</form>
	</div>
  <form method="post" action="">
  	<?php $db = mysqli_connect('localhost', 'root', '', 'todos') or die("QUERY failed" . mysqli_error($db));?>
  	<?php
  	if (isset($_POST['submit'])) {
  	 	$title = $_POST['title'];
  	 	$description = $_POST['description'];
  	 	$end_date = $_POST['end_date'];
  	 	//$flag = $_POST['flag'];
  	 	$query = "INSERT INTO tasks (title, description, end_date) VALUES ('$title', '$description', '$end_date')";
  	 	$run_query = mysqli_query($db, $query);
  	 } 
  	?>
  	<input type="text" name="title">
  	<input type="text" name="description">
  	<input type="date" name="end_date">
  	<select name="flags">
  		<option>Днес</option>
  		<option>Eдна седмица</option>
  		<option>Повече от една седмица</option>
  	</select>
  	<button type="submit" name="submit">Add task</button>
  </form>
  <table>
  	<thead>
  	  <tr>
  		<th>N</th>
  		<th></th>
  		<th>User</th>
  		<th></th>
  		<th>Task</th>
        <th></th>
        <th>Description</th>
        <th></th>
  		<th>Action</th>
  		<th></th>
  		<th>Date created</th>
  		<th>End Date</th>
  	  </tr>	
  	</thead>
  	<tbody>
  		<?php
  		$run_task = mysqli_query($db, "SELECT * FROM tasks");
        while ($row = mysqli_fetch_assoc($run_task)) {
        	$id = $row ['id']; 
        	$title = $row ['title'];
        	$description = $row ['description'];
        	$create_date = $row ['create_date'];
        	$end_date = $row ['end_date'];
        	//$flag = $row ['flag'];
  		?>
  		<tr>
  			<td><?php echo $id; ?></td>
  			<td></td>
  			<td><?php echo $_SESSION ['username']; ?></td>
  			<td></td>
  			<td><?php echo $title;  ?></td>
  			<td></td>
  			<td><?php echo $description; ?></td>
  			<td></td>
  			<td class="edit"><a href="update.php?edit=<? echo $id; ?>" class="btn btn-warning">UPDATE</a></td>
  			<td class="delete"><a href="index.php?delete=<?php echo $id;?>" class="btn btn-success">DELETE</a></td>
  			<td><?php echo $create_date; ?></td>
  			<td><?php echo $end_date;?></td>
  			<td></td>
  			<!--<td><?php 
  			//if (isset($_POST['submit'])) {
	           // $flag = $_POST['flag'];}
  			//if (!empty($_POST)) {
  			//if ($flag == 'Днес') {
  			    //echo 'ДНЕС';
  			//}elseif($flag == 'Eдна седмица'){
  				//echo "ПРЕДСТОИ";
  			//}elseif($flag == 'Повече от една седмица'){
  				//echo "НАБЛИЖАВА";
  			//} 
  		//}?></td>-->
  		</tr>
  	<?php } ?>
  	</tbody>
  	<?php
     if (isset($_GET['delete'])) {
     	$delete = $_GET['delete'];
     	$query = "DELETE FROM tasks WHERE id = '$delete'";
     	$run=mysqli_query($db,$query);
     		header('location:index.php');
     	}
     	?>
  </table>
</body>
</html>
