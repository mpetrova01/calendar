<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
<link rel="stylesheet" type="text/css" href="style1.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
      <p> <a href="index.php?logout='1'"  class="btn btn-default">log out</a> </p>
    	<p>Welcome, <strong><i><?php echo $_SESSION['username']; ?></i></strong></p>
      <!--<p><a href="tasks.php"  class="btn btn-default">Tasks</a></p>-->
    <?php endif ?>
</div>
		<!--<form method="get" action="server.php">
     <input type="text" name="task" placeholder ="Task">
     <input type="text" name="description" placeholder ="Description of your task">
     <input type="date" name="end_date" placeholder ="End date">
     <input type="submit" name="submit" value="Add task">
   </form>-->
<?php
if (isset($_GET['submit'])) {
  echo $_SESSION['task'];
  header('location:index.php');
}
?>
<?php
//session_start();
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
