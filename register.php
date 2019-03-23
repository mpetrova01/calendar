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
  	<h2>Register</h2>
  </div>-->
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="container login-container">
       <div class="row">
        <div class="col-md-12 login-form">
           <p><h1><i><b>Register</b></i></h1><p>
      <div class="form-group">
  	  <label>Username</label>
  	  <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="form-group">
    <label>Email</label>
  	  <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="form-group">
  	  <label>Password</label>
  	  <input type="password" class="form-control" name="password_1">
  	</div>
  	<div class="form-group">
  	  <label>Confirm password</label>
  	  <input type="password" class="form-control" name="password_2">
  	</div>
  	<div class="form-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </div>
</div>
</div>
  </form>
</body>
</html>
