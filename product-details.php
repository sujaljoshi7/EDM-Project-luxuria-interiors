<?php
include 'dbconnect.php';
session_start();
$pid = $_GET['p_id'];

$categoriessql = "SELECT * FROM categories";
$fetchcategories = mysqli_query($conn, $categoriessql);

$productssql = "SELECT * FROM products where p_id = $pid";
$fetchproducts = mysqli_query($conn, $productssql);

if (isset($_POST['addtocart'])) {
    if (isset($_SESSION['user_loggedin'])) {
        $email = $_SESSION['user_email'];
        $accountsql = "SELECT * FROM user where email = '$email'";
        $fetchaccount = mysqli_query($conn, $accountsql);
        $accountresult = mysqli_fetch_array($fetchaccount);
        $uid = $accountresult['u_id'];
        $date = date("j F");
        $quantity = mysqli_real_escape_string($conn, $_POST['qtybutton']);
        $cartsql = "SELECT * FROM cart where p_id = $pid";
        $fetchcart = mysqli_query($conn, $cartsql);
        if (mysqli_num_rows($fetchcart) > 0) {
            ?>
            <div style="position: fixed;top: 20px;right: 20px;z-index: 1050;"
                class="col-md-4 alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error</strong> Product already in cart!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div><?php
        } else {
            $addtocart = "INSERT INTO `cart`(`u_id`,`p_id`,`quantity`,`added_on`) VALUES ('$uid','$pid','$quantity','$date')";
            $insert = mysqli_query($conn, $addtocart);
            if ($insert) {
                ?>
                <div style="position: fixed;top: 20px;right: 20px;z-index: 1050;"
                    class="col-md-4 alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success</strong> Product added successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div><?php
            } else {
                ?>
                <div style="position: fixed;top: 20px;right: 20px;z-index: 1050;"
                    class="col-md-4 alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error</strong> Please try again later.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
            }
        }
    } else {
        header("location: login-register.php");
        exit;
    }
}


//$subcategorysql = "SELECT * FROM sub_categories where c_id = $cid";
//$fetchsubcategory = mysqli_query($conn,$subcategorysql);

?>

<!DOCTYPE html>
<html lang="zxx">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>sayyamcode eCommerce HTML Template</title>
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
        <!-- mini cart start -->


        <div class="product-details-area pb-100 pt-30">
            <?php
            $row = mysqli_fetch_array($fetchproducts);
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product-details-img-wrap" data-aos="fade-up" data-aos-delay="200">
                            <div class="easyzoom-style">
                                <div class="easyzoom easyzoom--overlay">
                                    <a href="assets/images/product-images/<?php echo ($row['image']) ?>">
                                        <img src="assets/images/product-images/<?php echo ($row['image']) ?>" alt="">
                                    </a>
                                </div>
                                <a class="easyzoom-pop-up img-popup"
                                    href="assets/images/product-images/<?php echo ($row['image']) ?>">
                                    <i class="pe-7s-search"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-details-content" data-aos="fade-up" data-aos-delay="400">
                            <h2><?php echo ($row['name']) ?> </h2>
                            <div class="product-details-price">
                                <span class="old-price">₹<?php echo ($row['mrp']) ?>/- </span>
                                <span class="new-price">₹<?php echo ($row['price']) ?>/-</span>
                            </div>

                            <form method="post" action="#">
                                <div class="product-details-action-wrap mt-4">
                                    <div class="product-quality">
                                        <input class="cart-plus-minus-box input-text qty text" name="qtybutton"
                                            value="1">
                                    </div>
                                    <div class="single-product-cart">
                                        <button type="submit" name="addtocart" style="background-color: #e97730;"
                                            class="btn">Add to cart</button>
                                    </div>
                            </form>
                            <div class="single-product-wishlist">
                                <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                            </div>
                        </div>
                        <?php
                        $scid = $row['s_c_id'];
                        $subcategoriessql = "SELECT * FROM sub_categories where s_c_id = $scid";
                        $fetchsubcategories = mysqli_query($conn, $subcategoriessql);
                        $subcategoryrow = mysqli_fetch_array($fetchsubcategories);
                        ?>
                        <div class="product-details-meta">
                            <ul>
                                <li><span class="title">SKU:</span> <?php echo ($row['sku']) ?> </li>
                                <li><span class="title">Category: </span>
                                    <ul>
                                        <li><a href="#"><?php echo ($subcategoryrow['name']) ?></a>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="description-review-area pb-85">
        <div class="container">
            <div class="description-review-topbar nav" data-aos="fade-up" data-aos-delay="200">
                <a class="active" data-bs-toggle="tab" href="#des-details1"> Description </a>
                <a data-bs-toggle="tab" href="#des-details2" class=""> Information </a>
            </div>
            <div class="tab-content">
                <div id="des-details1" class="tab-pane active">
                    <div class="product-description-content text-left">
                        <p data-aos="fade-up" data-aos-delay="400"><?php echo ($row['description']) ?></p>
                    </div>
                </div>
                <div id="des-details2" class="tab-pane">
                    <div class="specification-wrap table-responsive">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="width1">Brand</td>
                                    <td><?php echo ($row['brand']) ?></td>
                                </tr>
                                <tr>
                                    <td class="width1">Color</td>
                                    <td><?php echo ($row['color']) ?></td>
                                </tr>
                                <tr>
                                    <td class="width1">Material</td>
                                    <td><?php echo ($row['material']) ?></td>
                                </tr>
                                <tr>
                                    <td class="width1">Dimension (inches)</td>
                                    <td><?php echo ($row['dimension']) ?></td>
                                </tr>
                                <tr>
                                    <td class="width1">Assembly</td>
                                    <td><?php echo ($row['assembly']) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="des-details3" class="tab-pane">
                    <div class="review-wrapper">
                        <h3>1 review for Sleeve Button Cowl Neck</h3>
                        <div class="single-review">
                            <div class="review-img">
                                <img src="assets/images/product-details/review-1.png" alt="">
                            </div>
                            <div class="review-content">
                                <div class="review-rating">
                                    <a href="#"><i class="ti-star"></i></a>
                                    <a href="#"><i class="ti-star"></i></a>
                                    <a href="#"><i class="ti-star"></i></a>
                                    <a href="#"><i class="ti-star"></i></a>
                                    <a href="#"><i class="ti-star"></i></a>
                                </div>
                                <h5><span>HasTech</span> - April 29, 2022</h5>
                                <p>Donec accumsan auctor iaculis. Sed suscipit arcu ligula, at egestas magna
                                    molestie a. Proin ac ex maximus, ultrices justo eget, sodales orci. Aliquam
                                    egestas libero ac turpis pharetra, in vehicula lacus scelerisque</p>
                            </div>
                        </div>
                    </div>
                    <div class="ratting-form-wrapper">
                        <h3>Add a Review</h3>
                        <p>Your email address will not be published. Required fields are marked <span>*</span></p>
                        <div class="your-rating-wrap">
                            <span>Your rating</span>
                            <div class="your-rating">
                                <a href="#"><i class="ti-star"></i></a>
                                <a href="#"><i class="ti-star"></i></a>
                                <a href="#"><i class="ti-star"></i></a>
                                <a href="#"><i class="ti-star"></i></a>
                                <a href="#"><i class="ti-star"></i></a>
                            </div>
                        </div>
                        <div class="ratting-form">
                            <form action="#">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="rating-form-style mb-15">
                                            <label>Name <span>*</span></label>
                                            <input type="text">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="rating-form-style mb-15">
                                            <label>Email <span>*</span></label>
                                            <input type="email">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="rating-form-style mb-15">
                                            <label>Your review <span>*</span></label>
                                            <textarea name="Your Review"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="save-email-option">
                                            <p><input type="checkbox"> <label>Save my name, email, and website in
                                                    this browser for the next time I comment.</label></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-submit">
                                            <input type="submit" value="Submit">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <!-- Product Modal start -->
    <div class="modal fade quickview-modal-style" id="exampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><i class=" ti-close "></i></a>
                </div>
                <div class="modal-body">
                    <div class="row gx-0">
                        <div class="col-lg-5 col-md-5 col-12">
                            <div class="modal-img-wrap">
                                <img src="assets/images/product/quickview.png" alt="">
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-12">
                            <div class="product-details-content quickview-content">
                                <h2>New Modern Chair</h2>
                                <div class="product-details-price">
                                    <span class="old-price">$25.89 </span>
                                    <span class="new-price">$20.25</span>
                                </div>
                                <div class="product-details-review">
                                    <div class="product-rating">
                                        <i class=" ti-star"></i>
                                        <i class=" ti-star"></i>
                                        <i class=" ti-star"></i>
                                        <i class=" ti-star"></i>
                                        <i class=" ti-star"></i>
                                    </div>
                                    <span>( 1 Customer Review )</span>
                                </div>
                                <div class="product-color product-color-active product-details-color">
                                    <span>Color :</span>
                                    <ul>
                                        <li><a title="Pink" class="pink" href="#">pink</a></li>
                                        <li><a title="Yellow" class="active yellow" href="#">yellow</a></li>
                                        <li><a title="Purple" class="purple" href="#">purple</a></li>
                                    </ul>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ornare tincidunt
                                    neque vel semper. Cras placerat enim sed nisl mattis eleifend.</p>
                                <div class="product-details-action-wrap">
                                    <div class="product-quality">
                                        <input class="cart-plus-minus-box input-text qty text" name="qtybutton"
                                            value="1">
                                    </div>
                                    <div class="single-product-cart btn-hover">
                                        <a href="#">Add to cart</a>
                                    </div>
                                    <div class="single-product-wishlist">
                                        <a title="Wishlist" href="#"><i class="pe-7s-like"></i></a>
                                    </div>
                                    <div class="single-product-compare">
                                        <a title="Compare" href="#"><i class="pe-7s-shuffle"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Modal end -->
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