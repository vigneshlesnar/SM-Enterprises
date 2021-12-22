
<?php include_once($_SERVER['DOCUMENT_ROOT']."/SMenterprise/conn.php"); ?>
<?php  
    
$page_num = 1;
$page_limit = 10;

if (isset($_GET['page'])) {
    $page_num = filter_var($_GET['page'], FILTER_VALIDATE_INT, [
        'options' => [
            'default' => 1,
            'min_range' => 1
        ]
    ]);
}

$page_offset = $page_limit * ($page_num - 1);

$query = mysqli_query($conn, "SELECT * FROM `product` ORDER BY id LIMIT $page_limit OFFSET $page_offset");
$total_posts = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `product`"));

$total_page = ceil($total_posts / $page_limit);
$show_dots = false;
$next_page = $page_num + 1;
$prev_page = $page_num - 1;

if($total_page < $page_num){
    header('Location: '.$_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once($_SERVER['DOCUMENT_ROOT']."/SMenterprise/header.php"); ?>
<body>
<?php include_once($_SERVER['DOCUMENT_ROOT']."/SMenterprise/menu.php"); ?>  
        <div class="shop_sidebar_area">

            <!-- ##### Single Widget ##### -->
            <div class="widget catagory mb-50">
                <!-- Widget Title -->
                <h6 class="widget-title mb-30">Catagories</h6>

                <!--  Catagories  -->
                <div class="catagories-menu">
                    <ul>
                        <li class="active"><a href="category.php?category=Cushion">Cushion</a></li>
                        <li><a href="category.php?category=Wooden Gifts">Wooden Gifts</a></li>
                        <li><a href="category.php?category=Photo Frames">Photo Frames</a></li>
                        <li><a href="category.php?category=Mugs">Mugs</a></li>
                        <li><a href="category.php?category=Photo Clocks">Photo Clocks</a></li>
                        <li><a href="category.php?category=Miniature">Miniature</a></li>
                        <li><a href="category.php?category=Photo Lamps">Photo Lamps</a></li>
                        <li><a href="category.php?category=Customized Bottle">Customized Bottle</a></li>
                        <li><a href="category.php?category=Greeting Cards">Greeting Cards</a></li>
                        <li><a href="category.php?category=Keychains">Keychains</a></li>
                        <li><a href="category.php?category=Customized T-shirts">Customized T-shirts</a></li>
                        <li><a href="category.php?category=Personalized Gifts">Personalized Gifts</a></li>
                        <li><a href="category.php?category=Customized Momentos">Customized Momentos</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="amado_product_area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                <?php
                    if (mysqli_num_rows($query) > 0) :
                        while ($row = mysqli_fetch_array($query)) :
                        echo '<div class="col-12 col-sm-6 col-md-12 col-xl-6">
                            <div class="single-product-wrapper">
                                <!-- Product Image -->
                                <div class="product-img img-hover-zoom--slowmo">
                                    <img src="img/'.$row['pro_image'].'" alt="" style="width:100%;height:350px;">
                                </div>
            
                                <!-- Product Description -->
                                <div class="product-description d-flex align-items-center justify-content-between">
                                    <!-- Product Meta Data -->
                                    <div class="product-meta-data">
                                        <div class="line"></div>
                                        <p class="product-price">&#8377;'.$row['price'].'</p>
                                        <a href="product-details.html">
                                            <h6>'.$row['pro_name'].'</h6>
                                        </a>
                                    </div>
                                    <!-- Ratings & Cart -->
                                    <div class="ratings-cart text-right">
                                        <div class="ratings">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                        <div class="cart">
                                            <a href="cart.php?id='.$row['id'].'" data-toggle="tooltip" data-placement="left" title="Add to Cart"><img src="img/core-img/cart.png" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            
                        endwhile;
                    ?>
                 </div>
                    <ul class="pagination">
                    <?php
                if ($page_num > 1) :
                    echo '<li><a href="?page=' . $prev_page . '" class="page_link">Prev</a></li>';
                endif;

                for ($i = 1; $i <= $total_page; $i++) {

                    if ($i == $page_num) {

                        echo '<li><span>' . $i . '</span></li>';
                        $show_dots = true;

                    } else {

                        if ($i <= 1 || ($page_num && $i >= $page_num - 1 && $i <= $page_num + 1) || $i > $total_page - 1) {

                            echo '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
                            $show_dots = true;

                        } elseif ($show_dots) {

                            echo '<li><span>&hellip;</span></li>';
                            $show_dots = false;

                        }
                    }
                    
                }

                if ($total_page + 1 != $next_page) :
                    echo '<li><a href="?page=' . $next_page . '" class="page_link">Next</a></li>';
                endif;
                ?>
              </ul>
              <?php endif; ?>
                    
               
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

</body>

</html>