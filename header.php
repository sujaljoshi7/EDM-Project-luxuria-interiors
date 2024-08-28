<header class="header-area header-responsive-padding header-height-1">
    <div class="header-top d-none d-lg-block bg-gray">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-6">
                    <div class="welcome-text">
                        <?php
                        $currentHour = date("H") + 3;
                        // Determine the appropriate greeting based on the current hour
                        if ($currentHour >= 5 && $currentHour < 12) {
                            ?>
                            <p>Good Morning! </p>
                            <?php
                        } elseif ($currentHour >= 12 && $currentHour < 17) {
                            ?>
                            <p>Good Afternoon! </p>
                            <?php
                        } else {
                            ?>
                            <p>Good Evening! </p>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="col-lg-6 col-6">
                    <div class="language-currency-wrap">
                        <div class="currency-wrap border-style">
                            <a class="currency-active" href="#">₹ Rupee (INR) </a>
                        </div>
                        <div class="language-wrap">
                            <a class="language-active" href="#"><img src="assets/images/icon-img/flag.png" alt="">
                                English</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom sticky-bar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="logo">
                        <a href="index.php"><img src="assets/images/logo/logo.png" alt="logo"></a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block d-flex justify-content-center">
                    <div class="main-menu text-center">
                        <nav>
                            <ul>
                                <li><a href="index.php">HOME</a>
                                </li>
                                <li><a href="#" class="disabled">SHOP</a>
                                    <ul class="mega-menu-style mega-menu-mrg-1">
                                        <li>
                                            <ul>
                                                <?php while ($row = mysqli_fetch_array($fetchcategories)) {
                                                    $cid = $row['c_id']
                                                        ?>
                                                    <li>
                                                        <a class="dropdown-title"
                                                            href="shop.php?c_id=<?php echo $cid ?>"><?php echo $row['name'] ?></a>
                                                    </li>
                                                <?php } ?>


                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="about-us.php">ABOUT</a></li>
                                <li><a href="contact-us.html">CONTACT US</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="header-action-wrap">
                        <div class="header-action-style header-search-1">
                            <a class="search-toggle" href="#">
                                <i class="pe-7s-search s-open"></i>
                                <i class="pe-7s-close s-close"></i>
                            </a>
                            <div class="search-wrap-1">
                                <form action="#">
                                    <input placeholder="Search products…" type="text">
                                    <button class="button-search"><i class="pe-7s-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="header-action-style">
                            <?php
                            if (isset($_SESSION['user_loggedin'])) {
                                ?>
                                <a title="Account" href="my-account.php"><i class="pe-7s-user"></i></a>
                                <?php
                            } else {
                                ?>
                                <a title="Login Register" href="login-register.php"><i class="pe-7s-user"></i></a>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="header-action-style">
                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                        </div>
                        <div class="header-action-style header-action-cart">
                            <a title="Cart" class="cart" href="cart.php"><i class="pe-7s-shopbag"></i>
                            </a>
                        </div>
                        <div class="header-action-style d-block d-lg-none">
                            <a class="mobile-menu-active-button" href="#"><i class="pe-7s-menu"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>