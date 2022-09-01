<?php 
session_start();
define('TEMPLATE', true);

include_once('connect.php');


?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>Home</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="css/cart.css">
  <link rel="stylesheet" href="css/category.css">
  <link rel="stylesheet" href="css/product.css">
  <link rel="stylesheet" href="css/search.css">
  <link rel="stylesheet" href="css/success.css">
  <script src="js/jquery-3.3.1.js"></script>
  <script src="js/bootstrap.js"></script>
</head>

<body>

  <!--	Header	-->
  <div id="header">
    <div class="container">
      <div class="row">
        <!-- Gọi file logo header  -->
        <?php include_once('modules/logo/logo.php'); ?>
        <!-- Gọi file search box -->
        <?php include_once('modules/search/search_box.php'); ?>
        <!-- Gọi file cart notify -->
        <?php include_once('modules/cart/cart_notify.php'); ?>
      </div>
    </div>
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
  <!--	End Header	-->

  <!--	Body	-->
  <div id="body">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <!-- Gọi file menu  -->
          <?php include_once('modules/category/menu.php'); ?>
        </div>
      </div>
      <div class="row">
        <div id="main" class="col-lg-8 col-md-12 col-sm-12">
          <!--	Slider	-->
          <div id="slide" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <!-- Gọi file slide  -->
            <?php include_once('modules/slide/slide.php'); ?>

            <!-- The slideshow -->
            <!-- Gọi file slide show  -->
            <?php include_once('modules/slide/slide_show.php'); ?>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#slide" data-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#slide" data-slide="next">
              <span class="carousel-control-next-icon"></span>
            </a>

          </div>
          <!--	End Slider	-->

          <?php
          if (isset($_GET['page_layout'])) {
            switch ($_GET['page_layout']) {
              case 'category':
                include_once('modules/category/category.php');
                break;
              case 'search':
                include_once('modules/search/search.php');
                break;
              case 'product':
                include_once('modules/products/product.php');
                break;
              case 'cart':
                include_once('modules/cart/cart.php');
                break;
              case 'success':
                include_once('modules/cart/success.php');
                break;
            }
          } else {
            include_once('modules/products/featured.php');
            include_once('modules/products/latest.php');
          }
          ?>

        </div>

        <div id="sidebar" class="col-lg-4 col-md-12 col-sm-12">
          <!-- Gọi file banner  -->
          <?php include_once('modules/banner/banner.php'); ?>
        </div>
      </div>
    </div>
  </div>
  <!--	End Body	-->

  <div id="footer-top">
    <div class="container">
      <div class="row">
        <!-- Gọi file logo footer  -->
        <?php include_once('modules/logo/logo_footer.php'); ?>
        <!-- Gọi file address  -->
        <?php include_once('modules/address/address.php'); ?>
        <!-- Gọi file service  -->
        <?php include_once('modules/service/service.php'); ?>
        <!-- Gọi file hotline  -->
        <?php include_once('modules/hotline/hotline.php'); ?>
      </div>
    </div>
  </div>

  <!--	Footer	-->
  <!-- Gọi file footer bottom -->
  <?php include_once('modules/footer/footer_bottom.php'); ?>
  <!--	End Footer	-->













</body>

</html>