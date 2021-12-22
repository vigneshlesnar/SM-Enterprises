<?php include_once($_SERVER['DOCUMENT_ROOT']."/SMenterprise/conn.php"); ?>
<?php
 $check=" "; 
 if(!empty($_GET['id']))
 {  
     $id=$_GET['id'];
     $sql ="SELECT * FROM `category` WHERE `id`='$id'";
     $res = $conn -> query($sql);
     while($row=$res->fetch_assoc())
     {
        $image= $row["image"];
        $category= $row["category"];
    
     }
   
     if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
        
        echo "<pre>";
        print_r($_FILES['my_image']);
        echo "</pre>";
        $category=$_POST['category'];
        $img_name = $_FILES['my_image']['name'];
        $img_size = $_FILES['my_image']['size'];
        $tmp_name = $_FILES['my_image']['tmp_name'];
        $error = $_FILES['my_image']['error'];
    
        if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png"); 

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = 'img/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                // Insert into Database
                $sql="UPDATE `category` SET `image`='$new_img_name',`category`='$category' WHERE `id`='$id' ";
                $res = $conn -> query($sql);
                if($res===TRUE)   
                {
                        $check= "Updated";
                }
                else
                {
                    echo $conn->error;
                }
            }else {
                $em = "You can't upload files of this type";
            }
        }else {
            $em = "unknown error occurred!";
        }
    
    }else
    {
        echo $conn->error;
    }
    
    

    
    
        
}


function secure($s)
{
 $s=trim($s);
 $s=htmlentities($s);
 $s=stripslashes($s);
 return $s;
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
				<h5 class="pink-text text-darken-2 center bold">Edit Category</h5>
				<div class="container"><?php echo $check; ?>
                    <!-- <?php echo '<img src="img/'.$image.'" style="width:150px;"';?> -->
					<form method="POST" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']);?>" enctype="multipart/form-data"><br><br>
						<input name="my_image" placeholder="Image" id="blog_image" type="file" class="validate grey lighten-4">
						<br><br>
						<input name="category" placeholder="Imagetext" id="text_image" type="text" class="validate grey lighten-4" value="<?php echo $category;?>">
						<br><br>
						<button value="Edit" name="submit" type="submit" style="width:100%" class="btn pink darken-2 hoverable">Edit</button>
						<br><br>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>