<?php
include 'dbconnect.php';
session_start();
$categoriessql = "SELECT * FROM categories where visibility = 1";
$fetchcategories = mysqli_query($conn, $categoriessql);

if (isset($_SESSION['user_loggedin'])) {
    $email = $_SESSION['user_email'];
    $accountsql = "SELECT * FROM user where email = '$email'";
    $fetchaccount = mysqli_query($conn, $accountsql);
    $accountresult = mysqli_fetch_array($fetchaccount);
    if ($accountresult["active"] != 1) {
        header("location: account-disabled.php");
        exit;
    } elseif ($accountresult["verification"] == 0) {
        header("location: otp-verification.php");
        exit;
    }
}

?>


<!DOCTYPE html>
<html lang="zxx">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Wishlist | luxuria interiors</title>
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
        <div class="wishlist-area pb-100 pt-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <form action="#">
                            <div class="wishlist-table-content">
                                <div class="table-content table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="width-remove"></th>
                                                <th class="width-thumbnail"></th>
                                                <th class="width-name">Product</th>
                                                <th class="width-price"> Unit price </th>
                                                <th class="width-stock-status"> Stock status </th>
                                                <th class="width-wishlist-cart"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="product-remove"><a href="#">×</a></td>
                                                <td class="product-thumbnail">
                                                    <a href="product-details.html"><img
                                                            src="assets/images/cart/cart-1.jpg" alt=""></a>
                                                </td>
                                                <td class="product-name">
                                                    <h5><a href="product-details.html">Stylish Swing Chair</a></h5>
                                                </td>
                                                <td class="product-wishlist-price"><span class="amount">$120.00</span>
                                                </td>
                                                <td class="stock-status">
                                                    <span><i class="las la-check"></i> In Stock</span>
                                                </td>
                                                <td class="wishlist-cart btn-hover"><a href="#">Add to Cart</a></td>
                                            </tr>
                                            <tr>
                                                <td class="product-remove"><a href="#">×</a></td>
                                                <td class="product-thumbnail">
                                                    <a href="product-details.html"><img
                                                            src="assets/images/cart/cart-2.jpg" alt=""></a>
                                                </td>
                                                <td class="product-name">
                                                    <h5><a href="product-details.html">Modern Lounge Chairs</a></h5>
                                                </td>
                                                <td class="product-wishlist-price"><span class="amount">$120.00</span>
                                                </td>
                                                <td class="stock-status">
                                                    <span><i class="las la-check"></i> In Stock</span>
                                                </td>
                                                <td class="wishlist-cart btn-hover"><a href="#">Add to Cart</a></td>
                                            </tr>
                                            <tr>
                                                <td class="product-remove"><a href="#">×</a></td>
                                                <td class="product-thumbnail">
                                                    <a href="product-details.html"><img
                                                            src="assets/images/cart/cart-3.jpg" alt=""></a>
                                                </td>
                                                <td class="product-name">
                                                    <h5><a href="product-details.html">Modern Swivel Chair</a></h5>
                                                </td>
                                                <td class="product-wishlist-price"><span class="amount">$120.00</span>
                                                </td>
                                                <td class="stock-status">
                                                    <span><i class="las la-check"></i> In Stock</span>
                                                </td>
                                                <td class="wishlist-cart btn-hover"><a href="#">Add to Cart</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer-area">
            <div class="bg-gray-2">
                <div class="container">
                    <div class="footer-top pt-80 pb-35">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="footer-widget footer-about mb-40">
                                    <div class="footer-logo">
                                        <a href="index.html"><img src="assets/images/logo/logo.png" alt="logo"></a>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, cons adipi elit, sed do eiusmod tempor incididunt ut
                                        aliqua.</p>
                                    <div class="payment-img">
                                        <a href="#"><img src="assets/images/icon-img/payment.png" alt="logo"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="footer-widget footer-widget-margin-1 footer-list mb-40">
                                    <h3 class="footer-title">Information</h3>
                                    <ul>
                                        <li><a href="about-us.html">About Us</a></li>
                                        <li><a href="#">Delivery Information</a></li>
                                        <li><a href="#">Privacy Policy</a></li>
                                        <li><a href="#">Terms & Conditions</a></li>
                                        <li><a href="#">Customer Service</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                                <div class="footer-widget footer-list mb-40">
                                    <h3 class="footer-title">My Accound</h3>
                                    <ul>
                                        <li><a href="my-account.html">My Account</a></li>
                                        <li><a href="#">Order History</a></li>
                                        <li><a href="wishlist.html">Wish List</a></li>
                                        <li><a href="#">Newsletter</a></li>
                                        <li><a href="#">Order History</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="footer-widget footer-widget-margin-2 footer-address mb-40">
                                    <h3 class="footer-title">Get in touch</h3>
                                    <ul>
                                        <li><span>Address: </span>Your address goes here </li>
                                        <li><span>Telephone Enquiry:</span> (012) 345 6789</li>
                                        <li><span>Email: </span>demo@example.com</li>
                                    </ul>
                                    <div class="open-time">
                                        <p>Open : <span>8:00 AM</span> - Close : <span>18:00 PM</span></p>
                                        <p>Saturday - Sunday : Close</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-3">
                <div class="container">
                    <div class="footer-bottom copyright text-center bg-gray-3">
                        <p>Copyright ©2022 All rights reserved | Made with <i class="fa fa-heart"></i> by <a
                                href="https://www.youtube.com/@sayyamCode"> SayyamCode</a>.</p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Product Modal start -->
        <div class="modal fade quickview-modal-style" id="exampleModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><i
                                class=" ti-close "></i></a>
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