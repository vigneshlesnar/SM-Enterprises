<?php include_once($_SERVER['DOCUMENT_ROOT']."/SMenterprise/conn.php"); ?>  
<?php 
// Include the database configuration file  
      
error_reporting(0);
        if (isset($_POST['submit']) && isset($_FILES['pro_image'])) {
        
            echo "<pre>";
            print_r($_FILES['pro_image']);
            echo "</pre>";
            $name=$_POST['name'];
            $price=$_POST['price'];
            $category=$_POST['category'];
            $img_name = $_FILES['pro_image']['name'];
            $img_size = $_FILES['pro_image']['size'];
            $tmp_name = $_FILES['pro_image']['tmp_name'];
            $error = $_FILES['pro_image']['error'];
        
            if ($error === 0) {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
    
                $allowed_exs = array("jpg", "jpeg", "png","webp"); 
    
                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path = 'img/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
    
                    // Insert into Database
                    $sql = "INSERT INTO `product` (`pro_image`,`pro_name`,`price`,`category`) 
                            VALUES('$new_img_name','$name','$price','$category')";
                    mysqli_query($conn, $sql);
                }else {
                    $em = "You can't upload files of this type";
                }
            }else {
                $em = "unknown error occurred!";
            }
        
        }
        
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
<br><br><br>
<div class="container">
	<div class="row">
		<div class="col s12 offset-m1 m10 offset-l3 l6">
			<div class="card z-depth-3 hoverable grey lighten-4"><br>
				<h5 class="pink-text text-darken-2 center bold">Add product</h5>
				<div class="container"><?php echo $em; ?>
					<form method="POST" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']);?>" enctype="multipart/form-data"><br><br>
						<input name="pro_image" placeholder="Image" id="blog_image" type="file" class="validate grey lighten-4" required>
						<br><br>
                        <input name="category" placeholder="Category" id="text_image" type="text" class="validate grey lighten-4">
						<br><br>
						<input name="name" placeholder="Product Name" id="text_image" type="text" class="validate grey lighten-4">
						<br><br>
                        <input name="price" placeholder="Fixed Price" id="text_image" type="text" class="validate grey lighten-4">
						<br><br>
						<button value="Add" name="submit" type="submit" style="width:100%" class="btn pink darken-2 hoverable">Add</button>
						<br><br>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">ID</th>
							   <th>IMAGE</th>
							   <th>PRODUCTNAME</th>
							   <th>PRICE</th>
                               <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php
							$i=1;
                            $sql = "SELECT * FROM `product`";
                            $res = mysqli_query($conn,  $sql);
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td><?php echo $row['id'];?></td>
                               <td><?php echo $row['category'];?></td>
                               <td><?php echo '<img src="img/'.$row['pro_image'].'" style="width:150px;"';?></td>
							   <td><?php echo $row['pro_name'];?></td>
                               <td><?php echo $row['price'];?></td>
							   <td>
								<?php
								echo "<span class=' btn orange darken-2 hoverable'><a href='proedit.php?id=".$row['id']."'>Edit</a></span>&nbsp;";

								echo "<span class='btn red darken-2 hoverable'><a href='delete.php?page=product&id=".$row['id']."'>Delete</a></span>";

								?>
                                
							   </td>
							</tr>
							<?php } ?>
						 </tbody>
					  </table>
				   </div>
				</div>
</body>
</html>
