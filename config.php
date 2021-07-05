<?php
define('DBSERVER', 'localhost');
define('DBUSERNAME','root');
define('DBPASSWORD','');
define('DBNAME','demo');

$db = mysql_connect(DBSERVER,DBUSERNAME,DBPASSWORD,DBNAME);

if ($db == false){
	die("Error:connection error.". mysql_connect_error())
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>welcome <?php echo $_SESSION["name"];?></title>
</head>
<body>


<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Hello, <strong><? php echo $_SESSION["name"]; ?></strong> welcome </h1>
		</div>
		<p>
			<a href="logout.php" class="btn btn-secondaty btn-lg active" role ="button" aria-pressed="true">log out</a>
		</p>
	</div>
</div>
</body>
</html>