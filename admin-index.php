<?php
session_start();
error_reporting(0);
if(!isset($_SESSION['admin_username']) || !isset($_SESSION['admin_id']))
{
	header("Location: admin.php");
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Style+Script&display=swap" rel="stylesheet">
	<title>Index_Admin</title>
</head>
<body>
    <h3 class="center bold">SM ENTERPRISE</h3>
    <br><br>
    <div class="container">
		<div class="row">
			<div class="center">
				<a href="addcategory.php" class="btn red darken-2 z-depth-3 hoverable" style="width:100%; max-width:300px; margin:auto">Add Category</a><br><br>
				<a href="addproduct.php" class="btn blue darken-2 z-depth-3 hoverable" style="width:100%; max-width:300px; margin:auto">Add Product</a><br><br>
				<a href="addgallery.php" class="btn red darken-2 z-depth-3 hoverable" style="width:100%; max-width:300px; margin:auto">Add Portfolios</a><br><br>
		        <a href="addclients.php" class="btn blue darken-2 z-depth-3 hoverable" style="width:100%; max-width:300px; margin:auto">Add Clients</a><br><br>
            </div>            
		</div>
	</div>
</body>
</html>