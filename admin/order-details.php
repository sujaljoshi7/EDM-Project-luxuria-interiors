<?php
include '../dbconnect.php';
session_start();

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] != true) {
    header("location: login.php");
    exit;
}

if (isset($_SESSION['admin_loggedin'])) {
    $oid = $_GET['o_id'];
    $products = array();
    $quantitys = array();
    $orderitemssql = "SELECT * FROM order_items where o_id = '$oid'";
    $fetchorderitems = mysqli_query($conn, $orderitemssql);

    $orderssql = "SELECT * FROM orders where o_id = '$oid'";
    $fetchorder = mysqli_query($conn, $orderssql);
    $orderresult = mysqli_fetch_array($fetchorder);
    $uid = $orderresult['u_id'];
}

$usersql = "SELECT * from user where u_id = $uid";
$fetchuser = mysqli_query($conn, $usersql);
$userresult = mysqli_fetch_array($fetchuser);

if (isset($_POST['submit'])) {
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $updatestatus = "UPDATE orders set status = $type where o_id = $oid";
    $result = mysqli_query($conn, $updatestatus);
    if ($result) {
        header("location: order-details.php?o_id=$oid");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>luxwatches admin</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Admin panel for luxuria interiors">
    <meta name="author" content="Sujal Joshi">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
    <style>
        .card-header {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <nav class="nav nav-tabs" id="myTab" role="tablist">
        <h1>Order Details #<?php echo $orderresult['order_id'] ?></h1>
    </nav>
    <br>
    <div class="tab-content" id="nav-tabContent" style="margin: auto 3rem;">
        <!-- Order Details -->
        <div class="tab-pane fade show active" id="order" role="tabpanel" aria-labelledby="nav-home-tab">
            <div id="" role="tablist">
                <div class="row ">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-inline h4">Order Details</div>
                            </div>
                            <div class="card-body">
                                <dl class="row">
                                    <dt class="col-sm-3">SKU</dt>
                                    <dt class="col-sm-7">Name</dt>
                                    <dt class="col-sm-2">Quantity</dt>
                                </dl>
                                <?php
                                $cartsubtotal = 0;
                                while ($orderitemsresult = mysqli_fetch_array($fetchorderitems)) {
                                    $productsql = "SELECT * from products where p_id = $orderitemsresult[p_id]";
                                    $fetchproduct = mysqli_query($conn, $productsql);
                                    $productresult = mysqli_fetch_array($fetchproduct);
                                    ?>
                                    <dl class="row">
                                        <dd class="col-sm-3"><?php echo $productresult['sku'] ?></dd>
                                        <dd class="col-sm-7"><?php echo $productresult['name'] ?></dd>
                                        <dd class="col-sm-2"><?php echo $orderitemsresult['quantity'] ?></dd>
                                    </dl>
                                    <?php
                                }
                                ?>
                                <dl class="row">
                                    <dd class="col-sm-4">Payment Mode: </dd>
                                    <dt class="col-sm-8"><?php echo $orderresult['type'] ?></dt>
                                    <dd class="col-sm-4">Total Price</dd>
                                    <dt class="col-sm-8">
                                        ₹<?php echo number_format($orderresult['total'], 0, '', ','); ?> <br>
                                    </dt>
                                </dl>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form action="#" method="post">
                            <div class="card">
                                <div class="card-header collapsed" role="tab" id="headingThree" data-toggle="collapse"
                                    href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    <h5 class="mb-0">
                                        Delivery Status
                                    </h5>
                                </div>
                                <?php
                                $order_status = $orderresult['status'];
                                if ($order_status == '-1') {
                                    $order_status_text = "Order Cancelled";
                                }
                                if ($order_status == '0') {
                                    $order_status_text = "Order Confirmed";
                                }
                                if ($order_status == '1') {
                                    $order_status_text = "Order Packed";
                                }
                                if ($order_status == '2') {
                                    $order_status_text = "In Transit";
                                }
                                if ($order_status == '3') {
                                    $order_status_text = "Out for Delivery";
                                }
                                if ($order_status == '4') {
                                    $order_status_text = "Delivered";
                                }
                                ?>
                                <div id="collapseThree" class="collapse show" role="tabpanel"
                                    aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="">Current Status:
                                                <?php echo $order_status_text ?></label><br><br>
                                            <label for="esp" class="col-md-4 col-form-label ">Delivery Status</label>
                                            <div class="col-md-8 col-sm-12">
                                                <select class="custom-select col-md-8" id="esp" name="type" required>
                                                    <option value="" selected>Choose...</option>
                                                    <option value="0">Order Confirmed</option>
                                                    <option value="1">Packed</option>
                                                    <option value="2">In Transit</option>
                                                    <option value="3">Out for Delivery</option>
                                                    <option value="4">Delivered</option>
                                                    <option value="-1">Order Cancelled</option>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <input
                                                        style="background-color: #04AA6D;border: none;color: white;padding: 10px 100px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 20px 4px; border-radius: 10px;"
                                                        value="Update" type="submit" name="submit">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- End of Order Details -->
        <!--Product Info  -->
        <div class="tab-pane fade" id="product" role="tabpanel" aria-labelledby="nav-profile-tab">
            Display Product Info Content
        </div>
        <!--Factory Order  -->
        <div class="tab-pane fade" id="factory" role="tabpanel" aria-labelledby="nav-profile-tab">
            Display Factory Order Content
        </div>
        <!--Customer Info  -->
        <div class="tab-pane fade" id="customer" role="tabpanel" aria-labelledby="nav-contact-tab">
            Display Customer Info Content
        </div>
        <!--Files   -->
        <div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="nav-contact-tab">
            Display Files
        </div>
    </div>
    </div>
</body>

</html>