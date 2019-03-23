<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration</title>
<link rel="stylesheet" type="text/css" href="style1.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
  <!--<div class="header">
  	<h2>Login</h2>
  </div>-->
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
    <div  class="container login-container">
      <div class="row">
        <div class="col-md-12 login-form">
           <p><h1><i><b>Login</b></i></h1><p>
  	<div class="form-group">
  		<label>Username</label>
  		<input type="text" class="form-control" name="username">
  	</div>
  	<div class="form-group">
  		<label>Password</label>
  		<input type="password" class="form-control" name="password">
  	</div>
  	<div class="form-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </div>
  </div>
  </div>
  </div>
  </form>
</body>
</html>
