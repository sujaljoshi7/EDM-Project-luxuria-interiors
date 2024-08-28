<?php
include 'dbconnect.php';
session_start();
if (isset($_GET['c_id'])) {
    $cid = $_GET['c_id'];
    $productssql = "SELECT * FROM products where c_id = $cid";
    $fetchproducts = mysqli_query($conn, $productssql);
    // Handle the case where c_id is set
} elseif (isset($_GET['s_c_id'])) {
    $scid = $_GET['s_c_id'];
    $productssql = "SELECT * FROM products where s_c_id = $scid";
    $fetchproducts = mysqli_query($conn, $productssql);
    if ($row1 = mysqli_fetch_array($fetchproducts)) {
        $cid = $row1['c_id'];
        // Reset the pointer to the first row for later use
        mysqli_data_seek($fetchproducts, 0);
    }
    // Handle the case where s_c_id is set
} else {
    $productssql = "SELECT * FROM products";
    $fetchproducts = mysqli_query($conn, $productssql);
}
if (mysqli_num_rows($fetchproducts) > 0) {

    $countproducts = mysqli_num_rows($fetchproducts);

    $categoriessql = "SELECT * FROM categories";
    $fetchcategories = mysqli_query($conn, $categoriessql);

    $subcategorysql = "SELECT * FROM sub_categories where c_id = $cid";
    $fetchsubcategory = mysqli_query($conn, $subcategorysql);
} else {
    echo "0 Products";
}

?>

<!DOCTYPE html>
<html lang="zxx">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Shop - luxuria interiors</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description"
        content="SayyamCode eCommerce Bootstrap 5 Template is a stunning eCommerce website template that is the best choice for any online store.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="canonical" href="#" />

    <!-- Open Graph (OG) meta tags are snippets of code that control how URLs are displayed when shared on social media  -->
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="sayyamcode eCommerce HTML Template" />
    <meta property="og:url" content="#" />
    <meta property="og:site_name" content="sayyamcode eCommerce HTML Template" />
    <!-- For the og:image content, replace the # with a link of an image -->
    <meta property="og:image" content="#" />
    <meta property="og:description"
        content="SayyamCode eCommerce Bootstrap 5 Template is a stunning eCommerce website template that is the best choice for any online store." />
    <!-- Add site Favicon -->
    <link rel="icon" href="assets/images/favicon/cropped-favicon-32x32.png" sizes="32x32" />
    <link rel="icon" href="assets/images/favicon/cropped-favicon-192x192.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="assets/images/favicon/cropped-favicon-180x180.png" />
    <meta name="msapplication-TileImage" content="assets/images/favicon/cropped-favicon-270x270.png" />

    <!-- All CSS is here
    ============================================ -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="assets/css/vendor/themify-icons.css" />
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/animate.css" />
    <link rel="stylesheet" href="assets/css/plugins/aos.css" />
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup.css" />
    <link rel="stylesheet" href="assets/css/plugins/swiper.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/jquery-ui.css" />
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css" />
    <link rel="stylesheet" href="assets/css/plugins/select2.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/easyzoom.css" />
    <link rel="stylesheet" href="assets/css/plugins/slinky.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
</head>




<body>
    <div class="main-wrapper main-wrapper-2">
        <?php include 'header.php'; ?>
        <div class="shop-area shop-page-responsive pt-30 pb-100">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-lg-9">
                        <div class="shop-topbar-wrapper mb-40">
                            <div class="shop-topbar-left">
                                <div class="showing-item">
                                    <span> Showing <?php echo $countproducts ?> Products</span>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (mysqli_num_rows($fetchproducts) > 0) {
                            ?>
                            <div class="shop-bottom-area">
                                <div class="tab-content jump">
                                    <div id="shop-1" class="tab-pane active">
                                        <div class="row">
                                            <?php while ($row = mysqli_fetch_array($fetchproducts)) {
                                                $pid = $row['p_id'];
                                                $mrp = (int) $row['mrp'];
                                                $price = (int) $row['price'];
                                                $formatted_mrp = number_format($mrp, 0, '', ',');
                                                $formatted_price = number_format($price, 0, '', ',');
                                                $discount = 100 - $price / $mrp * 100;
                                                $discount = (int) $discount;
                                                ?>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                                    <div class="product-wrap mb-35" data-aos="fade-up" data-aos-delay="200">
                                                        <div class="product-img img-zoom mb-25">
                                                            <a href="product-details.php?p_id=<?php echo ($pid) ?>">
                                                                <img src="assets/images/product-images/<?php echo $row['image'] ?>"
                                                                    alt="product image">
                                                            </a>
                                                            <div class="product-badge badge-top badge-right badge-pink">
                                                                <span>- <?php echo $discount ?>%</span>
                                                            </div>

                                                            <div class="product-action-2-wrap">
                                                                <button class="product-action-btn-2" name="add_to_cart"
                                                                    title="Add To Cart"><i class="pe-7s-cart"></i> Add to
                                                                    cart</button>
                                                            </div>
                                                        </div>
                                                        <div class="product-content">
                                                            <h3><a href="product-details.php"><span
                                                                        class="truncate"><?php echo $row['name'] ?></span></a>
                                                            </h3>
                                                            <div class="product-price">
                                                                <span class="old-price">₹<?php echo $formatted_mrp ?>/- </span>
                                                                <span class="new-price">₹<?php echo $formatted_price ?>/-
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <div class="col-lg-3">
                        <div class="sidebar-wrapper">
                            <div class="sidebar-widget mb-40" data-aos="fade-up" data-aos-delay="200">
                                <div class="search-wrap-2">
                                    <form class="search-2-form" action="#">
                                        <input placeholder="Search*" type="text">
                                        <button class="button-search"><i class=" ti-search "></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="sidebar-widget sidebar-widget-border mb-40 pb-35" data-aos="fade-up"
                                data-aos-delay="200">
                                <div class="sidebar-widget-title mb-25">
                                    <h3>Product Categories</h3>
                                </div>
                                <div class="sidebar-list-style">
                                    <ul>
                                        <?php
                                        $categorycount = mysqli_num_rows($fetchsubcategory);

                                        while ($row = mysqli_fetch_array($fetchsubcategory)) {
                                            $scid = $row['s_c_id'];
                                            $productcount = "SELECT * FROM products where s_c_id = $scid";
                                            $resultproductsql = mysqli_query($conn, $productcount);
                                            $countproducts = mysqli_num_rows($resultproductsql);
                                            ?>
                                            <li><a href="shop.php?s_c_id=<?php echo $scid ?>"><?php echo $row['name'] ?>
                                                    <span><?php echo $countproducts ?></span></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php' ?>

        <!-- Mobile Menu start -->
        <div class="off-canvas-active">
            <a class="off-canvas-close"><i class=" ti-close "></i></a>
            <div class="off-canvas-wrap">
                <div class="welcome-text off-canvas-margin-padding">
                    <p>Default Welcome Msg! </p>
                </div>
                <div class="mobile-menu-wrap off-canvas-margin-padding-2">
                    <div id="mobile-menu" class="slinky-mobile-menu text-left">
                        <ul>
                            <li>
                                <a href="#">HOME</a>
                                <ul>
                                    <li><a href="index.html">Home version 1 </a></li>
                                    <li><a href="index-2.html">Home version 2</a></li>
                                    <li><a href="index-3.html">Home version 3</a></li>
                                    <li><a href="index-4.html">Home version 4</a></li>
                                    <li><a href="index-5.html">Home version 5</a></li>
                                    <li><a href="index-6.html">Home version 6</a></li>
                                    <li><a href="index-7.html">Home version 7</a></li>
                                    <li><a href="index-8.html">Home version 8</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">SHOP</a>
                                <ul>
                                    <li>
                                        <a href="#">Shop Layout</a>
                                        <ul>
                                            <li><a href="shop.html">Standard Style</a></li>
                                            <li><a href="shop-sidebar.html">Shop Grid Sidebar</a></li>
                                            <li><a href="shop-list.html">Shop List Style</a></li>
                                            <li><a href="shop-list-sidebar.html">Shop List Sidebar</a></li>
                                            <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                                            <li><a href="shop-location.html">Store Location</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Product Layout</a>
                                        <ul>
                                            <li><a href="product-details.html">Tab Style 1</a></li>
                                            <li><a href="product-details-2.html">Tab Style 2</a></li>
                                            <li><a href="product-details-gallery.html">Gallery style </a></li>
                                            <li><a href="product-details-affiliate.html">Affiliate style</a></li>
                                            <li><a href="product-details-group.html">Group Style</a></li>
                                            <li><a href="product-details-fixed-img.html">Fixed Image Style </a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">PAGES </a>
                                <ul>
                                    <li><a href="about-us.html">About Us </a></li>
                                    <li><a href="cart.html">Cart Page</a></li>
                                    <li><a href="checkout.html">Checkout </a></li>
                                    <li><a href="my-account.html">My Account</a></li>
                                    <li><a href="wishlist.html">Wishlist </a></li>
                                    <li><a href="compare.html">Compare </a></li>
                                    <li><a href="contact-us.html">Contact us </a></li>
                                    <li><a href="login-register.html">Login / Register </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">BLOG </a>
                                <ul>
                                    <li><a href="blog.html">Blog Standard </a></li>
                                    <li><a href="blog-sidebar.html">Blog Sidebar</a></li>
                                    <li><a href="blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="about-us.html">ABOUT US</a>
                            </li>
                            <li>
                                <a href="contact-us.html">CONTACT US</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="language-currency-wrap language-currency-wrap-modify">
                    <div class="currency-wrap border-style">
                        <a class="currency-active" href="#">$ Dollar (US) <i class=" ti-angle-down "></i></a>
                        <div class="currency-dropdown">
                            <ul>
                                <li><a href="#">Taka (BDT) </a></li>
                                <li><a href="#">Riyal (SAR) </a></li>
                                <li><a href="#">Rupee (INR) </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="language-wrap">
                        <a class="language-active" href="#"><img src="assets/images/icon-img/flag.png" alt=""> English
                            <i class=" ti-angle-down "></i></a>
                        <div class="language-dropdown">
                            <ul>
                                <li><a href="#"><img src="assets/images/icon-img/flag.png" alt="">English </a></li>
                                <li><a href="#"><img src="assets/images/icon-img/spanish.png" alt="">Spanish</a></li>
                                <li><a href="#"><img src="assets/images/icon-img/arabic.png" alt="">Arabic </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- All JS is here -->
    <script src="assets/js/vendor/modernizr-3.11.7.min.js"></script>
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="assets/js/vendor/jquery-migrate-3.3.2.min.js"></script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/plugins/wow.js"></script>
    <script src="assets/js/plugins/scrollup.js"></script>
    <script src="assets/js/plugins/aos.js"></script>
    <script src="assets/js/plugins/magnific-popup.js"></script>
    <script src="assets/js/plugins/jquery.syotimer.min.js"></script>
    <script src="assets/js/plugins/swiper.min.js"></script>
    <script src="assets/js/plugins/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/plugins/isotope.pkgd.min.js"></script>
    <script src="assets/js/plugins/jquery-ui.js"></script>
    <script src="assets/js/plugins/jquery-ui-touch-punch.js"></script>
    <script src="assets/js/plugins/jquery.nice-select.min.js"></script>
    <script src="assets/js/plugins/waypoints.min.js"></script>
    <script src="assets/js/plugins/jquery.counterup.js"></script>
    <script src="assets/js/plugins/select2.min.js"></script>
    <script src="assets/js/plugins/easyzoom.js"></script>
    <script src="assets/js/plugins/slinky.min.js"></script>
    <script src="assets/js/plugins/ajax-mail.js"></script>
    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
</body>


</html>