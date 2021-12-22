<?php include_once($_SERVER['DOCUMENT_ROOT']."/SMenterprise/conn.php"); ?>  
<?php
session_start();
$error="";
if(isset($_SESSION['admin_username']) && isset($_SESSION['admin_id']))
{
	header("Location:/SMenterprise/admin-index.php");
	exit();
}
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if(!empty($_POST['admin_username']) && !empty($_POST['admin_password']))
	{   

		$admin_username = $_POST['admin_username'];
		$admin_password = $_POST['admin_password'];
		// $hostname="localhost";
        // $dbusername="id17057627_sivraj12bond20frds";
        // $dbpassword="doxZ}E?\pDhy@6z/";
        // $database="id17057627_sivaranja";
        // $conn = new mysqli($hostname,$dbusername,$dbpassword,$database);
		$sqladmin = "SELECT * FROM `myadmin` WHERE `username`='$admin_username' AND `password`='$admin_password'";
		$result = $conn->query($sqladmin);
        if ($result == TRUE)
		{
			while($rowadmin = $result->fetch_assoc())
			{
				$_SESSION['admin_username'] = $rowadmin['username'];
				$admin_username = $_SESSION['admin_username'];
				$_SESSION['admin_id'] = $rowadmin['id'];
				$admin_id = $_SESSION['admin_id'];
				header("Location:/SMenterprise/admin-index.php");
				exit();
			}
		}
		else
		{
			$error= "<br><p class='red-text center'>Username or password is incorrect</p>";
		}
	}
	else
	{
		$error= "<br><p class='red-text center'>Please enter username and password.</p>";
	}
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Style+Script&display=swap" rel="stylesheet">
</head>
<body class="purple lighten-2">
<br><br><br>
<h3 class="white-text center bold">ADMIN PANEL</h3>
<div class="container">
	<div class="row">
		<div class="col s12 offset-m1 m10 offset-l3 l6">
			<div class="card z-depth-3 hoverable grey lighten-4"><br>
				<h5 class="pink-text text-darken-2 center bold">Admin Login</h5>
				<div class="container"><?php echo $error; ?>
					<form method="POST" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']);?>"><br><br>
						<input name="admin_username" placeholder="Username" id="admin_username" type="text" class="validate grey lighten-4" required>
						<br><br>
						<input name="admin_password" placeholder="Password" id="admin_password" type="password" class="validate grey lighten-4" required>
						<br><br>
						<button value="Login" name="submit" type="submit" style="width:100%" class="btn pink darken-2 hoverable">Login</button>
						<br><br>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
