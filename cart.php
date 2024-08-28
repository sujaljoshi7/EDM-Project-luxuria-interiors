<?php
include 'dbconnect.php';
session_start();
$categoriessql = "SELECT * FROM categories";
$fetchcategories = mysqli_query($conn, $categoriessql);


if (!isset($_SESSION['user_loggedin'])) {
    header('location:login-register.php');
}

if (isset($_SESSION['user_loggedin'])) {
    $email = $_SESSION['user_email'];
    $accountsql = "SELECT * FROM user where email = '$email'";
    $fetchaccount = mysqli_query($conn, $accountsql);
    $accountresult = mysqli_fetch_array($fetchaccount);
    $uid = $accountresult['u_id'];
    $cartsql = "SELECT * FROM cart where u_id = '$uid'";
    $fetchcart = mysqli_query($conn, $cartsql);
}


if (isset($_POST['clearcart'])) {
    $clearcartsql = "DELETE FROM cart WHERE u_id= $uid";
    $clearcart = mysqli_query($conn, $clearcartsql);
    header("location: cart.php");
    exit();
}

if (isset($_GET['del_id'])) {
    $ctid = $_GET['del_id'];
    $deleteproductssql = "DELETE FROM cart WHERE ct_id= $ctid";
    $deleteproducts = mysqli_query($conn, $deleteproductssql);
    if ($deleteproducts) {
        header("Location: cart.php");
    }
}

$sql = "SELECT * FROM cart where u_id = $uid";
$result = mysqli_query($conn, $sql);


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

        <?php
        if (mysqli_num_rows($result) > 0) {
            ?>
            <div class="cart-area pt-30 pb-100">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <form action="#" method="post">
                                <div class="cart-table-content">
                                    <div class="table-content table-responsive">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="width-thumbnail"></th>
                                                    <th class="width-name">Product</th>
                                                    <th class="width-price"> Price</th>
                                                    <th class="width-quantity">Quantity</th>
                                                    <th class="width-subtotal">Subtotal</th>
                                                    <th class="width-remove"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $cartsubtotal = 0;
                                                while ($cartresult = mysqli_fetch_array($fetchcart)) {
                                                    $ctid = $cartresult["ct_id"];
                                                    $pid = $cartresult["p_id"];
                                                    $productsql = "SELECT * from products where p_id = $pid";
                                                    $fetchproduct = mysqli_query($conn, $productsql);
                                                    while ($productresult = mysqli_fetch_array($fetchproduct)) {
                                                        $price = $productresult['price'];
                                                        $quantity = $cartresult['quantity'];
                                                        $subtotal = $price * $quantity;
                                                        $cartsubtotal = $cartsubtotal + $subtotal;

                                                        ?>
                                                        <tr>
                                                            <td class="product-thumbnail">
                                                                <a href="product-details.html"><img
                                                                        src="assets/images/product-images/<?php echo $productresult['image'] ?>"
                                                                        alt="Product Image"></a>
                                                            </td>
                                                            <td class="product-name">
                                                                <h5><a
                                                                        href="product-details.html"><?php echo $productresult['name'] ?></a>
                                                                </h5>
                                                            </td>
                                                            <td class="product-cart-price"><span
                                                                    class="amount">₹<?php echo number_format($productresult['price'], 0, '', ','); ?></span>
                                                            </td>
                                                            <td class="product-cart-price"><span
                                                                    class="amount"><?php echo $cartresult['quantity']; ?></span>
                                                            </td>
                                                            <td class="product-total">
                                                                <span>₹<?php echo number_format($subtotal, 0, '', ','); ?></span>
                                                            </td>
                                                            <td class="product-remove"><a
                                                                    href="cart.php?del_id=<?php echo $ctid; ?>"><i
                                                                        class=" ti-trash "></i></a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="cart-shiping-update-wrapper">
                                            <div class="cart-shiping-update btn-hover">
                                                <a href="#">Continue Shopping</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-lg-4 col-md-12 col-12">
                            <div class="grand-total-wrap">
                                <div class="grand-total-content">
                                    <h3>Subtotal <span>₹<?php echo number_format($cartsubtotal, 0, '', ','); ?></span></h3>
                                    <?php
                                    $shippingcharges = 100;
                                    $shippingchargestext = "₹100";
                                    if ($cartsubtotal > 1000) {
                                        $shippingcharges = 0;
                                        $shippingchargestext = "Free";
                                    }
                                    $gst = $cartsubtotal - ($cartsubtotal / (1 + (18 / 100)));
                                    $carttotal = $cartsubtotal + $shippingcharges + $gst;
                                    ?>
                                    <h5>Shipping charges <span><?php echo $shippingchargestext; ?></span></h5>
                                    <h6>GST (18%) <span>₹<?php echo number_format($gst, 0, '', ','); ?></span></h6>

                                    <div class="grand-total">
                                        <h4>Total <span>₹<?php echo number_format($carttotal, 0, '', ','); ?></span></h4>
                                    </div>
                                </div>
                                <div class="grand-total-btn btn-hover">
                                    <a class="btn theme-color" href="checkout.php">Proceed to checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="container-fluid  mt-100">
                <div class="row">

                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <h5>Empty Cart!</h5>
                            </div>
                            <div class="card-body cart">
                                <div class="col-sm-12 empty-cart-cls text-center">
                                    <img src="https://i.imgur.com/dCdflKN.png" width="130" height="130"
                                        class="img-fluid mb-4 mr-3">
                                    <h3><strong>Your Cart is Empty</strong></h3>
                                    <h4>Add something to make me happy :)</h4>
                                    <a href="index.php" class="btn btn-primary cart-btn-transform m-3"
                                        data-abc="true">continue
                                        shopping</a>


                                </div>
                            </div>
                        </div>


                    </div>

                </div>

            </div>
            <?php
        }
        ?>
        <?php include 'footer.php'; ?>
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