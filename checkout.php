<?php
include 'dbconnect.php';
include 'smtp/PHPMailerAutoload.php';
session_start();
$categoriessql = "SELECT * FROM categories";
$fetchcategories = mysqli_query($conn, $categoriessql);

if (!isset($_SESSION['user_loggedin'])) {
    header('location:login-register.php');
}

if (isset($_SESSION['user_loggedin'])) {
    $products = array();
    $quantitys = array();
    $email = $_SESSION['user_email'];
    $accountsql = "SELECT * FROM user where email = '$email'";
    $fetchaccount = mysqli_query($conn, $accountsql);
    $accountresult = mysqli_fetch_array($fetchaccount);
    $uid = $accountresult['u_id'];
    $cartsql = "SELECT * FROM cart where u_id = '$uid'";
    $fetchcart = mysqli_query($conn, $cartsql);
    $cartsql1 = "SELECT * FROM cart where u_id = '$uid'";
    $fetchcart1 = mysqli_query($conn, $cartsql1);
    if ($fetchcart1) {
        while ($result1 = mysqli_fetch_array($fetchcart1)) {
            $pid1 = $result1['p_id'];
            $quantity1 = $result1['quantity'];
            $products[] = $pid1;
            $quantitys[] = $quantity1;
            $totalProducts = count($products);
        }
    } else {
        echo "Error fetching cart items: " . mysqli_error($conn);
    }
}

$usersql = "SELECT * from user where u_id = $uid";
$fetchuser = mysqli_query($conn, $usersql);
$userresult = mysqli_fetch_array($fetchuser);

function generateRandomString($length = 12)
{
    return strtoupper(bin2hex(random_bytes($length / 2)));
}

function generateOrderId()
{
    return 'ORD-' . date('YmdHis') . '-' . strtoupper(bin2hex(random_bytes(4)));
}
if (isset($_POST['submit'])) {
    $timestamp = date("YmdHis");
    $randomNumber = rand(100, 999); // Generate a 3-digit random number
    $orderId = "ORD-" . $timestamp . "-" . $randomNumber; // Combine to create order_id
    $invoiceNumber = "INV-" . $timestamp . "-" . $randomNumber; // Combine to create order_id   
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $apt = mysqli_real_escape_string($conn, $_POST['apt']);
    $street = mysqli_real_escape_string($conn, $_POST['street']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $zip = mysqli_real_escape_string($conn, $_POST['zip']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $customdate = date("j F");
    $timezone = new DateTimeZone("Asia/Kolkata");
    $date = new DateTime();
    $ndate = $date->setTimezone($timezone);
    $time = $date->format('H:i:');
    $headers = array(
        "MIME-VERSION" => "1.0",
        "Content-Type" => "text/html;charset=UTF-8",
        "From" => "testing.project.sou@gmail.com",
        "Reply-To" => "testing.project.sou@gmail.com"
    );
    $message = file_get_contents("order-confirmation.php");
    function smtp_mailer($to, $subject, $msg, $headers)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        //$mail->SMTPDebug = 2; 
        $mail->Username = "testing.project.sou@gmail.com";
        //$mail->Password = "Testingproject@sou";
        $mail->Password = "cgvcvkywhsubttvp";
        $mail->SetFrom("testing.project.sou@gmail.com");
        $mail->Subject = $subject;
        $mail->Body = $msg;
        $mail->AddAddress($to);
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => false
            )
        );
        if (!$mail->Send()) {
            echo $mail->ErrorInfo;
        } else {
            return 'Sent';
        }
    }
    $addorder = "INSERT INTO `orders`(`u_id`,`order_id`,`invoice_number`,`f_name`,`l_name`,`country`,`apt_no`,`street`,`city`,`state`,`zip`,`phone`,`email`,`type`,`date`,`time`) VALUES ('$uid','$orderId','$invoiceNumber','$fname','$lname','$country','$apt','$street','$city','$state','$zip','$phone','$email','$type','$customdate','$time')";
    $result = mysqli_query($conn, $addorder);
    if ($result) {
        $orderId = $conn->insert_id;
        if (count($products) === count($quantitys)) {
            foreach ($products as $index => $product) {
                $quantity = $quantitys[$index];
                echo "Product ID: " . $product . " - Quantity: " . $quantity . "<br>";
                $additems = "INSERT INTO `order_items`(`o_id`,`p_id`,`quantity`) VALUES ('$orderId','$product','$quantity')";
                $result2 = mysqli_query($conn, $additems);
            }
        } else {
            echo "Error: Mismatch between number of products and quantities.";
        }
        if ($result2) {
            $clearcartsql = "DELETE FROM cart WHERE u_id= $uid";
            $clearcart = mysqli_query($conn, $clearcartsql);
            $result = smtp_mailer($email, 'Order Confirmation, luxuria interiors', $message, $headers);
            echo $result;
            if ($result) {
                echo "<form id='redirectForm' method='POST' action='order-successful.php'>";
                echo "<input type='hidden' name='orderId' value='" . htmlspecialchars($orderId) . "'>";
                echo "</form>";
                echo "<script>document.getElementById('redirectForm').submit();</script>";
                exit();
            } else {
                echo "No";
            }
            // HTML form to POST the orderId to the success page

        }
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
    <style>
        .long-text {
            width: 250px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
    </style>
</head>




<body>
    <div class="main-wrapper main-wrapper-2">
        <?php
        include 'header.php'
            ?>
        <form action="#" method="POST">
            <div class="checkout-main-area pb-100 pt-30">
                <div class="container">
                    <div class="checkout-wrap pt-30">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="billing-info-wrap">
                                    <h3>Billing Details</h3>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="billing-info mb-20">
                                                <label>First Name <abbr class="required"
                                                        title="required">*</abbr></label>
                                                <input type="text" name="fname"
                                                    value="<?php echo $userresult['f_name'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="billing-info mb-20">
                                                <label>Last Name <abbr class="required"
                                                        title="required">*</abbr></label>
                                                <input type="text" name="lname"
                                                    value="<?php echo $userresult['l_name'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="billing-select select-style mb-20">
                                                <label>Country <abbr class="required" title="required">*</abbr></label>
                                                <select class="select-two-active" name="country" required>
                                                    <option value="India">India</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="billing-info mb-20">
                                                <label>Street Address <abbr class="required"
                                                        title="required">*</abbr></label>
                                                <input class="billing-address"
                                                    placeholder="House number and street name" type="text" name="street"
                                                    required>
                                                <input placeholder="Apartment, suite, unit etc." type="text" name="apt"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="billing-info mb-20">
                                                <label>Town / City <abbr class="required"
                                                        title="required">*</abbr></label>
                                                <input type="text" name="city" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="billing-info mb-20">
                                                <label>State / County <abbr class="required"
                                                        title="required">*</abbr></label>
                                                <input type="text" name="state" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="billing-info mb-20">
                                                <label>Postcode / ZIP <abbr class="required"
                                                        title="required">*</abbr></label>
                                                <input type="text" name="zip" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="billing-info mb-20">
                                                <label>Phone <abbr class="required" title="required">*</abbr></label>
                                                <input type="text" name="phone" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="billing-info mb-20">
                                                <label>Email Address <abbr class="required"
                                                        title="required">*</abbr></label>
                                                <input type="text" name="email"
                                                    value="<?php echo $userresult['email'] ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="your-order-area">
                                    <h3>Your order</h3>
                                    <div class="your-order-wrap gray-bg-4">
                                        <div class="your-order-info-wrap">
                                            <div class="your-order-info">
                                                <ul>
                                                    <li>Product <span>Total</span></li>
                                                </ul>
                                            </div>
                                            <div class="your-order-middle">
                                                <ul>
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
                                                            <li>
                                                                <?php echo $productresult['name']; ?> X
                                                                <?php echo $cartresult['quantity']; ?>
                                                                <span>₹<?php echo $subtotal; ?> </span>
                                                            </li>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                            <div class="your-order-info order-subtotal">
                                                <ul>
                                                    <li>Subtotal <span>₹<?php echo $cartsubtotal; ?> </span></li>
                                                </ul>
                                            </div>
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
                                            <div class="your-order-middle">
                                                <ul>
                                                    <li>Shipping <span><?php echo $shippingchargestext ?> </span>
                                                    </li>
                                                    <li>GST (18%) <span>₹<?php echo number_format($gst, 0, '', ','); ?>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="your-order-info order-total">
                                                <ul>
                                                    <li>Total
                                                        <span>₹<?php echo number_format($carttotal, 0, '', ','); ?>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="payment-method">
                                            <div class="pay-top sin-payment">
                                                <input id="payment_method_1" class="input-radio" type="radio"
                                                    value="COD" checked="checked" name="type">
                                                <label for="payment_method_1"> Cash on delivery </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cart-clear btn-hover">
                                        <input class="btn" style="background-color:#e97730;" name="submit"
                                            value="Place Order" type="submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

</html>
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