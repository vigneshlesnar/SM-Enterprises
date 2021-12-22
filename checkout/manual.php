
<!DOCTYPE html>
<html lang="en">
<?php include_once($_SERVER['DOCUMENT_ROOT']."/SMenterprise/header.php"); ?>
<body>
<?php include_once($_SERVER['DOCUMENT_ROOT']."/SMenterprise/menu.php"); ?>  
        <!-- Product Catagories Area Start -->
        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
            <div class="col-12 col-lg-4">
                        <div class="cart-summary">
                            <h5>Cart Total</h5>
                            <ul class="summary-table">
                                <li><span>subtotal:</span> &#8377;<span id="result"></span></li>
                                <li><span>delivery:</span>&#8377; <span id="del">60</span></li>
                                <li><span>total:</span>&#8377; <span id="tol"><?php echo $paisa;?></span></li> 
                            </ul>

                            <div class="cart-btn mt-100">
                                <a href="" class="btn amado-btn w-100" id="rzp-button1">Payment</a>
                            </div>
                        </div>
                    </div>
               
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
    </section>
    <!-- ##### Newsletter Area End ##### -->
 <?php include_once($_SERVER['DOCUMENT_ROOT']."/SMenterprise/footer.php"); ?> 
 <script>
    var rp=document.getElementById("tol").innerText;
    var delivery=document.getElementById("del").innerText;
    var z = Number(rp) - Number(delivery);
    document.getElementById("result").innerText= z;
</script> 
</body>

</html>
<!-- <button id="rzp-button1">Payment</button> -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<form name='razorpayform' action="verify.php" method="POST">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
</form>
<script>
// Checkout details as a json
var options = <?php echo $json?>;

/**
 * The entire list of Checkout fields is available at
 * https://docs.razorpay.com/docs/checkout-form#checkout-fields
 */
options.handler = function (response){
    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
    document.getElementById('razorpay_signature').value = response.razorpay_signature;
    document.razorpayform.submit();
};

// Boolean whether to show image inside a white frame. (default: true)
options.theme.image_padding = false;

options.modal = {
    ondismiss: function() {
        console.log("This code runs when the popup is closed");
    },
    // Boolean indicating whether pressing escape key 
    // should close the checkout form. (default: true)
    escape: true,
    // Boolean indicating whether clicking translucent blank
    // space outside checkout form should close the form. (default: false)
    backdropclose: false
};

var rzp = new Razorpay(options);

document.getElementById('rzp-button1').onclick = function(e){
    rzp.open();
    e.preventDefault();
}
</script>