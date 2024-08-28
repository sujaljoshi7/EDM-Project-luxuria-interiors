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
    $ordersql = "SELECT * from orders where u_id = $uid";
    $fetchorder = mysqli_query($conn, $ordersql);
}



if (isset($_POST['update-account-details'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['f_name']);
    $lname = mysqli_real_escape_string($conn, $_POST['l_name']);
    $updateaccount = "UPDATE `user` SET `f_name` = '$fname',`l_name` = '$lname' WHERE `user`.`u_id` = '$uid'";
    $insert = mysqli_query($conn, $updateaccount);
    if ($insert) {
        header('location:my-account.php')
            ?>
        <div style="position: fixed;top: 20px;right: 20px;z-index: 1050;"
            class="col-md-4 alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success</strong> Account details updated successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div><?php
    }
}

if (isset($_POST['update-password'])) {
    $password = mysqli_real_escape_string($conn, $_POST['new-password']);
    $cnfpassword = mysqli_real_escape_string($conn, $_POST['cnf-password']);
    if ($password == $cnfpassword) {
        $passwordhash = password_hash($password, PASSWORD_BCRYPT);
        $updatepassword = "UPDATE `user` SET `password` = '$passwordhash' WHERE `u_id` = '$uid'";
        $insert = mysqli_query($conn, $updatepassword);
        if ($insert) {
            header('location:my-account.php');
        }
    } else {
        ?>
        <div style="position: fixed;top: 20px;right: 20px;z-index: 1050;"
            class="col-md-4 alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error</strong> Password and confirm password doesn.t match.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
    }
}

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

        <!-- my account wrapper start -->
        <div class="my-account-wrapper pb-100 pt-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- My Account Page Start -->
                        <div class="myaccount-page-wrapper">
                            <!-- My Account Tab Menu Start -->
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <div class="myaccount-tab-menu nav" role="tablist">
                                        <a href="#dashboad" class="active" data-bs-toggle="tab">Dashboard</a>
                                        <a href="#orders" data-bs-toggle="tab">Orders</a>
                                        <a href="#account-info" data-bs-toggle="tab">Account Details</a>
                                        <a href="#change-password" data-bs-toggle="tab">Change Password</a>
                                        <a href="login-register.html">Logout</a>
                                    </div>
                                </div>
                                <!-- My Account Tab Menu End -->
                                <!-- My Account Tab Content Start -->
                                <div class="col-lg-9 col-md-8">
                                    <div class="tab-content" id="myaccountContent">
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Dashboard</h3>
                                                <div class="welcome">
                                                    <p>Hello, <strong><?php echo $accountresult['f_name']; ?></strong>
                                                    </p>
                                                </div>

                                                <p class="mb-0">From your account dashboard. you can easily check & view
                                                    your recent orders, manage your shipping and billing addresses and
                                                    edit your password and account details.</p>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="orders" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Orders</h3>
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Order</th>
                                                                <th>Date</th>
                                                                <th>Status</th>
                                                                <th>Total</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $srno = 0;
                                                            while ($orderresult = mysqli_fetch_array($fetchorder)) {
                                                                $srno++;
                                                                if ($orderresult['status'] == "0") {
                                                                    $status = "Confirmed";
                                                                } elseif ($orderresult["status"] == "1") {
                                                                    $status = "In Transit";
                                                                } elseif ($orderresult['status'] == "-1") {
                                                                    $status = "Returned";
                                                                } else {
                                                                    $status = "Delivered";
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $srno ?></td>
                                                                    <td><?php echo $orderresult['date'] ?></td>
                                                                    <td><?php echo $status ?></td>
                                                                    <td>₹<?php echo number_format($orderresult['total'], 0, '', ','); ?>
                                                                    </td>
                                                                    <td><a href="cart.html"
                                                                            class="check-btn sqr-btn ">View</a></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="download" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Downloads</h3>
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Date</th>
                                                                <th>Expire</th>
                                                                <th>Download</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Haven - Free Real Estate PSD Template</td>
                                                                <td>Aug 22, 2022</td>
                                                                <td>Yes</td>
                                                                <td><a href="#" class="check-btn sqr-btn "><i
                                                                            class="fa fa-cloud-download"></i> Download
                                                                        File</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>HasTech - Profolio Business Template</td>
                                                                <td>Sep 12, 2022</td>
                                                                <td>Never</td>
                                                                <td><a href="#" class="check-btn sqr-btn "><i
                                                                            class="fa fa-cloud-download"></i> Download
                                                                        File</a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Payment Method</h3>
                                                <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Billing Address</h3>
                                                <address>
                                                    <p><strong>Alex Tuntuni</strong></p>
                                                    <p>1355 Market St, Suite 900 <br>
                                                        San Francisco, CA 94103</p>
                                                    <p>Mobile: (123) 456-7890</p>
                                                </address>
                                                <a href="#" class="check-btn sqr-btn "><i class="fa fa-edit"></i> Edit
                                                    Address</a>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="account-info" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Account Details</h3>
                                                <div class="account-details-form">
                                                    <form action="" method="post">
                                                        <div class="single-input-item">
                                                            <label for="display-name" class="required">First
                                                                Name</label>
                                                            <input type="text" id="display-name" name="f_name"
                                                                value="<?php echo $accountresult['f_name']; ?>" />
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="display-name1" class="required">Last
                                                                Name</label>
                                                            <input type="text" id="display-name1" name="l_name"
                                                                value="<?php echo $accountresult['l_name']; ?>" />
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="email" class="required">Email Addres</label>
                                                            <input type="email" id="email" disabled
                                                                value="<?php echo $accountresult['email']; ?>" />
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="phone" class="required">Phone Number</label>
                                                            <input type="number" disabled id="phone"
                                                                value="<?php echo $accountresult['phone']; ?>" />
                                                        </div>

                                                        <div class="single-input-item btn-hover">
                                                            <button class="check-btn sqr-btn"
                                                                name="update-account-details">Save Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> <!-- Single Tab Content End -->
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="change-password" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Change Password</h3>
                                                <div class="account-details-form">
                                                    <form action="" method="post">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="new-pwd" class="required">New
                                                                        Password</label>
                                                                    <input type="password" id="new-pwd"
                                                                        name="new_password" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="confirm-pwd" class="required">Confirm
                                                                        Password</label>
                                                                    <input type="password" id="confirm-pwd"
                                                                        name="cnf_password" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="single-input-item btn-hover">
                                                            <button class="check-btn sqr-btn"
                                                                name="update-password">Save Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> <!-- Single Tab Content End -->
                                    </div>
                                </div> <!-- My Account Tab Content End -->
                            </div>
                        </div> <!-- My Account Page End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- my account wrapper end -->
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