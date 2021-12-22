
<?php include_once($_SERVER['DOCUMENT_ROOT']."/SMenterprise/conn.php"); ?>
<?php
error_reporting(0);
     $sql = "SELECT * FROM `category`";
     $res = mysqli_query($conn,  $sql);

     if ($res==true) {
         while ($row=$res->fetch_assoc()) {  
           $id = $row['id'];
        
           $output .=  '<div class="single-products-catagory clearfix">
           <a href="category.php?category='.$row['category'].'">
               <img src="img/'.$row['image'].'" alt="" style="width:100%;height:350px;">
               <h4 style="text-align:center;margin-top:15px;">'.$row['category'].'</h4>
               <div class="line"></div>
               <!-- Hover Content -->
               <div class="hover-content">
                 </div>
                </a>
            </div>';
       }
   
   };
         

?>
<!DOCTYPE html>
<html lang="en">
<?php include_once($_SERVER['DOCUMENT_ROOT']."/SMenterprise/header.php"); ?>
<body>
<?php include_once($_SERVER['DOCUMENT_ROOT']."/SMenterprise/menu.php"); ?>  
        <!-- Product Catagories Area Start -->
        <div class="products-catagories-area clearfix">
            <div class="amado-pro-catagory clearfix">
                <?php echo $output;?>
               
            </div>
        </div>
        <!-- Product Catagories Area End -->
    </div><br>

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
    </section><br>
    <!-- ##### Newsletter Area End ##### -->
    <section>
        <div class="container">
         <div class="row pre_con">
             <div class="col-sm-3 col-md-3 pre_list">
                <img src="img/rupee.png" alt="" width="120px;">
                 <h4>Best Price Guarantee</h4>
                 <p>30 Days back</p>
            </div>
            <div class="col-sm-3 col-md-3 pre_list">
                 <img src="img/free-delivery.png" alt="" width="120px;">
                 <h4>Super Fast Processing</h4>
                 <p>Free delivery to your home</p>

            </div>
            <div class="col-sm-3 col-md-3 pre_list">
                 <img src="img/credit-card.png" alt="" width="120px;">
                 <h4>Payment Method</h4>
                 <p>Security system</p>
            </div>
         </div>
        </div>
  
    </section><br>

 <?php include_once($_SERVER['DOCUMENT_ROOT']."/SMenterprise/footer.php"); ?>  
</body>

</html>