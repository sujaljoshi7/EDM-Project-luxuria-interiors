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
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>SayyamCode</title>
  <meta name="robots" content="noindex, follow" />
  <meta name="description"
    content="SayyamCode eCommerce Bootstrap 5 Template is a stunning eCommerce website template that is the best choice for any online store." />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="profile" href="https://gmpg.org/xfn/11" />
  <link rel="canonical" href="#" />

  <!-- Open Graph (OG) meta tags are snippets of code that control how URLs are displayed when shared on social media  -->
  <meta property="og:locale" content="en_US" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="SayyamCode" />
  <meta property="og:url" content="#" />
  <meta property="og:site_name" content="SayyamCode" />
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

    <div class="about-us-area pt-30 pb-100">
      <div class="container">
        <div class="row align-items-center flex-row-reverse">
          <div class="col-lg-6">
            <div class="about-content text-center">
              <h2 data-aos="fade-up" data-aos-delay="200">Furniture</h2>
              <h1 data-aos="fade-up" data-aos-delay="300">Best Furniture</h1>
              <p data-aos="fade-up" data-aos-delay="400">
                At luxuria interiors, we are dedicated to crafting timeless pieces that transcend the ordinary. Our
                commitment to excellence is reflected in every detail, from the meticulous selection of materials to the
                masterful craftsmanship that goes into each creation. We believe that luxury is not just about opulence,
                but about the subtle art of blending comfort with elegance, creating an ambiance that resonates with
                your unique style.

                Our collection is a testament to our passion for design, where every piece is thoughtfully curated to
                elevate your living spaces. Whether it's a statement sofa, an exquisite dining table, or a bespoke
                bedroom set, our furniture embodies a perfect harmony of form and function. We take pride in offering
                not just furniture, but a lifestyle of sophistication and grace.
              </p>
              <p class="mrg-inc" data-aos="fade-up" data-aos-delay="500">
                At luxuria interiors, we strive to exceed your expectations by delivering unparalleled quality and
                personalized service. We invite you to explore our collection and discover the perfect pieces that will
                transform your home into a sanctuary of luxury and comfort.
              </p>
              <div class="btn-style-3 btn-hover" data-aos="fade-up" data-aos-delay="600">
                <a class="btn border-radius-none" href="product-details.html">Shop Now</a>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="about-img" data-aos="fade-up" data-aos-delay="400">
              <img src="assets/images/banner/about-us.png" alt="" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="banner-area pb-100">
      <div class="bg-img bg-padding-2" style="background-image: url(assets/images/bg/bg-2.png)">
        <div class="container">
          <div class="banner-content-5 banner-content-5-static">
            <span data-aos="fade-up" data-aos-delay="200">Up To 40% Off</span>
            <h1 data-aos="fade-up" data-aos-delay="400">
              New Furniture <br />Sofa Set
            </h1>
            <div class="btn-style-3 btn-hover" data-aos="fade-up" data-aos-delay="600">
              <a class="btn border-radius-none" href="product-details.html">Shop Now</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="testimonial-area pb-100">
      <div class="container">
        <div class="section-title-2 st-border-center text-center mb-75" data-aos="fade-up" data-aos-delay="200">
          <h2>Testimonial</h2>
        </div>
        <div class="testimonial-active swiper-container">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="single-testimonial" data-aos="fade-up" data-aos-delay="200">
                <div class="testimonial-img">
                  <img src="assets/images/testimonial/client-1.png" alt="" />
                </div>
                <p>
                  Exceptional quality and craftsmanship; our home has never looked more elegant.
                </p>
                <div class="testimonial-info">
                  <h4>Priya Mehta</h4>
                  <span> Our Client.</span>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="single-testimonial" data-aos="fade-up" data-aos-delay="400">
                <div class="testimonial-img">
                  <img src="assets/images/testimonial/client-2.png" alt="" />
                </div>
                <p>
                  Every piece feels tailor-made for us; we're beyond impressed.
                </p>
                <div class="testimonial-info">
                  <h4>Rohit Patel</h4>
                  <span> Our Client.</span>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="single-testimonial" data-aos="fade-up" data-aos-delay="600">
                <div class="testimonial-img">
                  <img src="assets/images/testimonial/client-1.png" alt="" />
                </div>
                <p>
                  Luxurious and timeless—this furniture has transformed our home.
                </p>
                <div class="testimonial-info">
                  <h4>Sneha Iyer</h4>
                  <span> Our Client</span>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="single-testimonial">
                <div class="testimonial-img">
                  <img src="assets/images/testimonial/client-2.png" alt="" />
                </div>
                <p>
                  Stunning designs that bring a touch of elegance to every room.
                </p>
                <div class="testimonial-info">
                  <h4>Aarti Joshi</h4>
                  <span> Our Client</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="funfact-area bg-img pt-100 pb-70" style="background-image: url(assets/images/bg/bg-4.png)">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-6 col-6">
            <div class="single-funfact text-center mb-30" data-aos="fade-up" data-aos-delay="200">
              <div class="funfact-img">
                <img src="assets/images/icon-img/client.png" alt="" />
              </div>
              <h2 class="count">120</h2>
              <span>Happy Clients</span>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-6">
            <div class="single-funfact text-center mb-30" data-aos="fade-up" data-aos-delay="400">
              <div class="funfact-img">
                <img src="assets/images/icon-img/award.png" alt="" />
              </div>
              <h2 class="count">90</h2>
              <span>Award Winning</span>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-6">
            <div class="single-funfact text-center mb-30" data-aos="fade-up" data-aos-delay="600">
              <div class="funfact-img">
                <img src="assets/images/icon-img/item.png" alt="" />
              </div>
              <h2 class="count">230</h2>
              <span>Totel Items</span>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-6">
            <div class="single-funfact text-center mb-30 mrgn-none" data-aos="fade-up" data-aos-delay="800">
              <div class="funfact-img">
                <img src="assets/images/icon-img/cup.png" alt="" />
              </div>
              <h2 class="count">350</h2>
              <span>Cups of Coffee</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="subscribe-area pb-100 pt-100">
      <div class="container">
        <div class="section-title-3 text-center mb-55" data-aos="fade-up" data-aos-delay="200">
          <h2>Join With Us!</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit seddo
            eiusmod tempor incididunt ut labore
          </p>
        </div>
        <div class="row">
          <div class="col-lg-8 offset-lg-2">
            <div id="mc_embed_signup" class="subscribe-form" data-aos="fade-up" data-aos-delay="400">
              <form id="mc-embedded-subscribe-form" class="validate subscribe-form-style" novalidate="" target="_blank"
                name="mc-embedded-subscribe-form" method="post"
                action="https://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef">
                <div id="mc_embed_signup_scroll" class="mc-form">
                  <input class="email" type="email" required="" placeholder="Email address…" name="EMAIL" value="" />
                  <div class="mc-news" aria-hidden="true">
                    <input type="text" value="" tabindex="-1" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef" />
                  </div>
                  <div class="clear">
                    <input id="mc-embedded-subscribe" class="button" type="submit" name="subscribe"
                      value="Subscribe Now" />
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include 'footer.php'; ?>
    <!-- Mobile Menu start -->
    <div class="off-canvas-active">
      <a class="off-canvas-close"><i class="ti-close"></i></a>
      <div class="off-canvas-wrap">
        <div class="welcome-text off-canvas-margin-padding">
          <p>Default Welcome Msg!</p>
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
                      <li>
                        <a href="shop-sidebar.html">Shop Grid Sidebar</a>
                      </li>
                      <li><a href="shop-list.html">Shop List Style</a></li>
                      <li>
                        <a href="shop-list-sidebar.html">Shop List Sidebar</a>
                      </li>
                      <li>
                        <a href="shop-right-sidebar.html">Shop Right Sidebar</a>
                      </li>
                      <li><a href="shop-location.html">Store Location</a></li>
                    </ul>
                  </li>
                  <li>
                    <a href="#">Product Layout</a>
                    <ul>
                      <li><a href="product-details.html">Tab Style 1</a></li>
                      <li>
                        <a href="product-details-2.html">Tab Style 2</a>
                      </li>
                      <li>
                        <a href="product-details-gallery.html">Gallery style
                        </a>
                      </li>
                      <li>
                        <a href="product-details-affiliate.html">Affiliate style</a>
                      </li>
                      <li>
                        <a href="product-details-group.html">Group Style</a>
                      </li>
                      <li>
                        <a href="product-details-fixed-img.html">Fixed Image Style
                        </a>
                      </li>
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
            <a class="currency-active" href="#">$ Dollar (US) <i class="ti-angle-down"></i></a>
            <div class="currency-dropdown">
              <ul>
                <li><a href="#">Taka (BDT) </a></li>
                <li><a href="#">Riyal (SAR) </a></li>
                <li><a href="#">Rupee (INR) </a></li>
              </ul>
            </div>
          </div>
          <div class="language-wrap">
            <a class="language-active" href="#"><img src="assets/images/icon-img/flag.png" alt="" /> English
              <i class="ti-angle-down"></i></a>
            <div class="language-dropdown">
              <ul>
                <li>
                  <a href="#"><img src="assets/images/icon-img/flag.png" alt="" />English
                  </a>
                </li>
                <li>
                  <a href="#"><img src="assets/images/icon-img/spanish.png" alt="" />Spanish</a>
                </li>
                <li>
                  <a href="#"><img src="assets/images/icon-img/arabic.png" alt="" />Arabic
                  </a>
                </li>
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