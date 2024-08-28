<?php
include 'dbconnect.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['orderId'])) {
    $orderId = htmlspecialchars($_POST['orderId']); // Retrieve and sanitize the orderId
    $fetchordersql = "SELECT * from orders where o_id = $orderId";
    $fetchorderresult = mysqli_query($conn, $fetchordersql);
    $fetchorder = mysqli_fetch_array($fetchorderresult);
    $productQuery = "
            SELECT od.p_id, od.quantity, p.name, p.price 
            FROM order_items od 
            JOIN products p ON od.p_id = p.p_id 
            WHERE od.o_id = '$orderId'";
        $productResult = mysqli_query($conn, $productQuery);
        
        
    
}else{
    header("location:index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
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
    @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');body{background-color: #e97730;font-family: 'Montserrat', sans-serif}.card{border:none}.logo{background-color: #eeeeeea8}.totals tr td{font-size: 13px}.footer{background-color: #eeeeeea8}.footer span{font-size: 12px}.product-qty span{font-size: 12px;color: #dedbdb}
    </style>
</head>
<body>
    
</body>
</html>



<div class="container mt-5 mb-5">

        <div class="row d-flex justify-content-center">

            <div class="col-md-8">

                <div class="card">


                        <div class="text-left logo p-2 px-4">

                            <img src="assets/images/logo/short-logo.png" width="30">
                            

                        </div>


                        <div class="invoice p-5">

                            <h5>Your order is Confirmed!</h5>

                            <span class="font-weight-bold d-block mt-4">Hello, <?php echo $fetchorder['f_name'] ?></span>
                            <span>You order has been confirmed and will be shipped within 7 working days!</span>

                            <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">

                                <table class="table table-borderless">
                                    
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="py-2">

                                                    <span class="d-block text-muted">Order Date</span>
                                                <span><?php echo $fetchorder['date'] ?></span>
                                                    
                                                </div>
                                            </td>

                                            <td>
                                                <div class="py-2">

                                                    <span class="d-block text-muted">Order No</span>
                                                <span><?php echo $fetchorder['order_id'] ?></span>
                                                    
                                                </div>
                                            </td>

                                            <td>
                                                <div class="py-2">

                                                    <span class="d-block text-muted">Payment</span>
                                                    <span><?php echo $fetchorder['type'] ?></span>
                                                    
                                                </div>
                                            </td>

                                            <td>
                                                <div class="py-2">

                                                    <span class="d-block text-muted">Shiping Address</span>
                                                <span><?php echo $fetchorder['apt_no']; ?>,<br> <?php echo $fetchorder['street']; ?>,<br> <?php echo $fetchorder['city']; ?></span>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                                <div class="product border-bottom table-responsive">
                                    <table class="table table-borderless">
                                    <tbody>
                                    <?php
                                    $cartsubtotal = 0;
                                    while ($product = mysqli_fetch_assoc($productResult)) {
                                        $productsql = "SELECT * from products where p_id = $product[p_id]";
                                        $productresult = mysqli_query($conn, $productsql);
                                        $fetchproduct = mysqli_fetch_array($productresult);
                                        ?>
                                        <tr>
                                            <td width="20%">  
                                            <img src="assets/images/product-images/<?php echo $fetchproduct['image'] ?>"
                                                                        alt="Product Image" width="90">
                                        </td>
                                    
                                        <td width="60%">
                                            <span class="font-weight-bold"><?php echo $product['name']; ?></span>
                                            <div class="product-qty">
                                                <span class="d-block">Quantity:<?php echo $product['quantity']; ?></span>
                                                <span>Color:<?php echo $fetchproduct['color']; ?></span>
                                            </div>
                                        </td>

                                        <td width="20%">
                                            <div class="text-right">
                                                <?php
                                                $producttotal = $product['price'] * $product['quantity'];
                                                $cartsubtotal = $cartsubtotal + $producttotal;
                                                ?>
                                                <span class="font-weight-bold">₹<?php echo number_format($producttotal, 0, '', ','); ?></span>
                                            </div>
                                        </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody> 
                                    </table>

                                </div>

                                <div class="row d-flex justify-content-end">

                                    <div class="col-md-5">

                                        <table class="table table-borderless">

                                            <tbody class="totals">

                                                <tr>
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="text-muted">Subtotal</span>
                                                            
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span>₹<?php echo number_format($cartsubtotal, 0, '', ','); ?></span>
                                                        </div>
                                                    </td>
                                                </tr>

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
                                                 <tr>
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="text-muted">Shipping Charges</span>
                                                            
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span><?php echo $shippingchargestext; ?></span>
                                                        </div>
                                                    </td>
                                                </tr>


                                                 <tr>
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="text-muted">Tax Fee (18%)</span>
                                                            
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span>₹<?php echo number_format($gst, 0, '', ','); ?></span>
                                                        </div>
                                                    </td>
                                                </tr>



                                                 <tr class="border-top border-bottom">
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="font-weight-bold">Total</span>
                                                            
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span class="font-weight-bold">₹<?php echo number_format($carttotal, 0, '', ','); ?></span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                            
                                        </table>
                                        
                                    </div>
                                    


                                </div>


                                <p>We will be sending shipping confirmation email when the item shipped successfully!</p>
                                <p class="font-weight-bold mb-0">Thanks for shopping with us!</p>
                                <span>luxuria interiors Team</span>



                            

                        </div>


                        <div class="d-flex justify-content-between footer p-3">

                            <span>Need Help? visit our <a href="#"> help center</a></span>
                             <span><a href="index.php">Continue Shopping >></a></span>
                            
                        </div>



            
                    </div>
                
            </div>
            
        </div>
        
    </div>