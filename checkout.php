<?php include_once($_SERVER['DOCUMENT_ROOT']."/SMenterprise/conn.php"); ?>
<?php
error_reporting(0);
session_start();
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    session_write_close();
} else {
    // since the username is not set in session, the user is not-logged-in
    // he is trying to access this page unauthorized
    // so let's clear all session variables and redirect him to index
    session_unset();
    session_write_close();
    $url = "/SMenterprise/signup/";
    header("Location: $url");
}

if(!empty($_GET['id']) && !empty($_GET['data']))
{  
    $id=$_GET['id'];
    $paisa=$_GET['data'];  
    $sql = "SELECT * FROM `product` WHERE `id`=$id ";
    $result=$conn->query($sql);
    if ($result==true)
   {
       while($row=$result->fetch_assoc())
       {   $id=$row['id'];
           $name=$row['pro_name'];
           $image=$row['pro_image'];
           $actualprice=$row['price'];
           $cate=$row['category'];
       }
    }else
    {
        echo $conn->error;
    }

}
?>
<?php
$check=" "; 
if($_SERVER['REQUEST_METHOD']== 'POST')
{   
        $fname=secure($_POST['first_name']); 
        $lname=secure($_POST['last_name']); 
        $email=secure($_POST['email']);
        $company=secure($_POST['company']);
        $address=secure($_POST['street_address']);
        $city=secure($_POST['city']);
        $zipCode=secure($_POST['zipCode']);
        $phone_number=secure($_POST['phone_number']);
        $comment=secure($_POST['comment']);
        $conn = new mysqli($hostname,$dbusername,$dbpassword,$database);
        $sql="INSERT INTO `checkout` (`email`, `frst_name`, `last_name`,`company`, `address`, `town`, `zipcode`,`phone`,`comment`) VALUES ('$email','$fname','$lname','$company','$address','$city','$zipCode','$phone_number','$comment')";
        $res = $conn -> query($sql);
        if($res===TRUE)
         {
            header('Location: /SMenterprise/pay.php?id='.$id.'&data='.$paisa.'');
         }else
         {
            $check="Oops! Something error";
            // echo $conn->error;
         }
        //   if($res===TRUE)   
        //         {
        //            echo "Sumbitted";
        //         }
        //         else
        //         {
        //            echo $conn->error;
        //         }
    
}else
{
    $check= "Please enter the above information";
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
<html lang="en">
<?php include_once($_SERVER['DOCUMENT_ROOT']."/SMenterprise/header.php"); ?>
<body>
<?php include_once($_SERVER['DOCUMENT_ROOT']."/SMenterprise/menu.php"); ?>
        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="checkout_details_area mt-50 clearfix">

                            <div class="cart-title">
                                <h2>Checkout</h2>
                            </div>

                            <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']);?>" method="POST" id="formABC">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" name="first_name" id="first_name" value="" placeholder="First Name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" name="last_name" id="last_name" value="" placeholder="Last Name" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control" name="company" id="company" placeholder="Company Name" value="">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="">
                                    </div>

                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control mb-3" name="street_address" id="street_address" placeholder="Address" value="">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control" name="city" id="city" placeholder="Town" value="">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" name="zipCode" id="zipCode" placeholder="Zip Code" value="">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="number" name="phone_number" class="form-control" id="phone_number" min="0" placeholder="Phone No" value="">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <textarea name="comment" class="form-control w-100" id="comment" cols="30" rows="10" placeholder="Leave a comment about your order"></textarea>
                                    </div>
                                </div>
                                <input class="btn btn-dark" type="submit" name="login-btn"
							   id="btnSubmit" value="Submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    <!-- ##### Newsletter Area Start ##### -->
    <section class="newsletter-area section-padding-100-0">
        <div class="container">
            <div class="row align-items-center">
                <!-- Newsletter Text -->
                <div class="col-12 col-lg-6 col-xl-7">
                    <div class="newsletter-text mb-100">
                        <h2>Subscribe for a <span>25% Discount</span></h2>
                        <p>Get unique & trendy gift ideas and best offers delivered to your inbox.</p>
                    </div>
                </div>
                <!-- Newsletter Form -->
                <div class="col-12 col-lg-6 col-xl-5">
                    <div class="newsletter-form mb-100">
                        <form action="#" method="post">
                            <input type="email" name="email" class="nl-email" placeholder="Your E-mail">
                            <input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Newsletter Area End ##### -->

<?php include_once($_SERVER['DOCUMENT_ROOT']."/SMenterprise/menu.php"); ?>
</body>

</html>