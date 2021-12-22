<?php include_once($_SERVER['DOCUMENT_ROOT']."/SMenterprise/conn.php"); ?>
<?php
// error_reporting(0);
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

if(!empty($_GET['id']))
{  
    $id=$_GET['id'];   
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
<!DOCTYPE html>
<html lang="en">
<?php include_once($_SERVER['DOCUMENT_ROOT']."/SMenterprise/header.php"); ?>
<body>
<?php include_once($_SERVER['DOCUMENT_ROOT']."/SMenterprise/menu.php"); ?>

        <div class="cart-table-area section-padding-100">
                <h2>Hi! <?php echo $username;?> Have More Gifts...</h2>
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="cart-title mt-50">
                            <h2>Shopping Cart</h2>
                        </div>

                        <div class="cart-table clearfix">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="cart_product_img">
                                            <a href="#"><img src="img/<?php echo $image;?>" alt="Product"></a>
                                        </td>
                                        <td class="cart_product_desc">
                                            <h5><?php echo $name?></h5>
                                        </td>
                                        <td class="price">
                                            <p>&#8377;<span id="rupee"><?php echo $actualprice;?>.00</span></p>
                                        </td>
                                        <td class="qty">
                                            <div class="qty-btn d-flex">
                                                <p>Qty</p>
                                                <div class="quantity">
                                                <p><span onclick="decrement();"><i class="fa fa-minus" aria-hidden="true"></i></span>&nbsp;&nbsp;<span id="counting" style="color:#7d1935;font-size:1.5em;"></span>&nbsp;&nbsp;<span onclick="increment()"><i class="fa fa-plus" aria-hidden="true"></i></span></p>
                                                    <!-- <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                                    <input type="number" class="qty-text" id="qty" step="1" min="1" max="300" name="quantity" value="1">
                                                    <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span> -->
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="cart-summary">
                            <h5>Cart Total</h5>
                            <ul class="summary-table">
                                <li><span>subtotal:</span> &#8377;<span id="result"><?php echo $actualprice;?></span></li>
                                <li><span>delivery:</span>&#8377; <span id="del">60</span></li>
                                <li><span>total:</span>&#8377; <span id="tol"></span></li>
                            </ul>
                            <div class="cart-btn mt-100">
                                <p onclick="myfun();" class="btn amado-btn w-100">Checkout</p>
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
    <?php include_once($_SERVER['DOCUMENT_ROOT']."/SMenterprise/footer.php"); ?>
    <script>
    var data = 1;
    document.getElementById("counting").innerText = data;
    var rp=document.getElementById("result").innerText;
    var delivery=document.getElementById("del").innerText;
    var z = Number(delivery) + Number(rp);
    document.getElementById("tol").innerText= z;
    function increment() {
        data = data + 1;
        document.getElementById("counting").innerText = data;
        var rup=document.getElementById("rupee").innerText;
        var am= data * rup;
        document.getElementById("result").innerText= am;
        var delivery=document.getElementById("del").innerText;
        var z = Number(delivery) + Number(am);
        document.getElementById("tol").innerText= z;
    
    }
    function decrement() {
        if(data>1)
        {
        data = data - 1;
        document.getElementById("counting").innerText = data;
        var res=document.getElementById("result").innerText;
        var rup=document.getElementById("rupee").innerText;
        var amt= res - rup ;
        document.getElementById("result").innerText= amt;
        var delivery=document.getElementById("del").innerText;
        var z = Number(delivery) + Number(amt);
        document.getElementById("tol").innerText= z;
        }
    }
 
</script> 
<script>
     function myfun(){
       
    var textprevi=document.getElementById("tol").innerHTML;
   window.open("/SMenterprise/checkout.php?id="+ <?php echo $id;?> +"&&data=" + textprevi,"_self");
   }
</script>
</body>

</html>