<?php

require_once "config.php";
require_once "session.php";

if ($_SERVER ["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){

  $email = trim ($_POST['email']);
  $password = trim ($_POST['password']);

  if (empty($email)){
  	$error.='<p class="error">please enter email.</p>';

  }
  if (empty($password)){
  	$error.='<p class="error">please enter password.</p>';
  	
  }
    if (empty($error)){
  	if ($querry=$db->prepare("SELECT * FROM users WHERE email =?")) {
  		$query->db2_bind_param('s',$email);
  		$query->execute();
  		$row =$ query->fetch();
  		if ($row){
  			if (password_verify($password, $row['password'])){
  				$_SESSION["userid"]=$row['id'];
  				$_SESSION["user"]=$row;
  				header("location:welcome.php");
  				exit;

  			}else{
  				$error.='<p class ="error"> password not valid</p>';
  			}
  		}else{
  				$error.='<p class ="error">no user exist with this email address </p>';
  			}
  	}
  	$query->close();
  }
  mysql_close($db);

?>

  <!DOCTYPE html>
  <html>
  <head>
  	<title>login </title>
  </head>
  <body>
  	 <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>login</h2>
          <p>please fill in your email and password</p>
          <?php echo $error;?>
          <form action=""method ="post">
            <div class="form-group">
              <label>Email Address</label>
              <input type="email" name="email" class="form-control"required>
            </div>
            <div class="form-group">
              <label>Paswword</label>
              <input type="password" name="password" class="form-control"required>
            </div>
            <div class="form-control">
              <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </div>
            <p>Don't have an account  <a href="register.php">Register here</a>.</p> 
        </form>
    </div>
</div>
</div>
  
  </body>
  </html>