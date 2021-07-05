<?php

require_once "config.php";
require_once "session.php";

if ($_SERVER ["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){


  $fullname = trim ($_POST['name']);
  $email = trim ($_POST['email']);
  $password = trim ($_POST['password']);
  $confirm_password = trim ($_POST['confirm_password']);
  $password_hash = password_hash($password, PASSWORD_BCRYPT);

  if($query=$db->prepare ("SELECT * FROM user WHERE email =?")) 
  {
    $error ='';
    $query->bind_param('s',$email);
    $query->execute();
    $query->store_result();

     if ($query->num_row > 0){
      $error.='<p class= "error"> This email is already registered</P> ';

     }
     else {
      if (strlen($password)<6){
        $error.=<'p class ="error">Password must have atleast 6 characters.</p>';
      }

    if (empty ($confirm_password)){
      $error.='<p class= "error"> please confrim the email</P> ';

     }else{
      if(empty($error)&& ($password !=$confirm_password))
        $error.='<p class= "error"> password did not match</P> ';
     }

    }
    if (empty($error)){
      $insertQuery =$db->prepare("INSERT INTO (user,email,password) VALUES (?,?,?);");
      $insertQuery->bind_param("sss",$fullname,$email,$password_hash);
      $result = $insertQuery->execute();
      if ($result){
        $error.='<p class="success">Registration is a success</p>';
      }
    }


  }


}
$query->close();
$insertQuery->close();
mysql_close($db);
}
?>


<!DOCTYPE html>  
<html>  
<head>  
<meta charset="UTF-8">
<title>sign up</title>
<link rel="stylesheet"  href="">
<head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>register</h2>
          <p>please fill this form to create an account</p>
          <form action=""method ="post">
            <div class="form-group">
              <label>Full Name</label>
              <input type="text" name="name" class="form-control"required>
            </div>
            <div class="form-control">
              <label>Email Address</label>
              <input type="Email" name="Email" class="form-control"required>
            </div>
            <div class="form-control">
              <label>Password</label>
              <input type="password" name="password" class="form-control"required>
            </div>
            <div class="form-control">
              <label>Confirm Password</label>
              <input type="password" name="password" class="form-control"required>
            </div>
            <div class="form-control">
              <input type="submit" name="submit" class="btn btn-primary" value="submit">
            </div>
            <p>Already have an Account <a href="login.php">Login here</a>.</p> 
          </form>
        </div>
      </div>
    </div>
  </body>
</head>

</html>