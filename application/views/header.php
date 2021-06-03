<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>REQ FILM</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?php echo base_url('assets3/img/chilli.png');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets1/font-awesome/4.5.0/css/font-awesome.min.css');?>">

    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
    <!-- Owl Carousel main css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/owl.carousel.min.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/owl.theme.default.min.css');?>">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/core.css');?>">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/shortcode/shortcodes.css');?>">
    <!-- Theme main style -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css');?>">
    <!-- Responsive css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/responsive.css');?>">
    <!-- User style -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/custom.css');?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets1/css/dataTables.bootstrap.min.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets1/css/responsive.bootstrap.min.css');?>">
      
    <!-- <script type="text/javascript" src="<?php echo base_url('assets1/js/jquery.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets1/js/jquery.dataTables.js');?>"></script> -->
      
    <script type="text/javascript" src="<?php echo base_url('assets1/js/ace-extra.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets1/js/jquery-2.1.4.min.js');?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/js/vendor/modernizr-2.8.3.min.js');?>"></script>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    <div class="wrapper fixed__footer">
        <!-- Start Header Style -->
        <header id="header" class="htc-header header--3 bg__white" style="background-color: white;">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__area sticky__header" style="background-color: white;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 col-lg-2 col-sm-3 col-xs-3">
                            <div class="logo">
                                
                                    <img src="<?php echo base_url('assets/images/logo/logo2.png');?>" alt="logo">
                                
                            </div>
                        </div>
                        <!-- Start MAinmenu Ares -->
                        <div class="col-md-8 col-lg-8 col-sm-6 col-xs-6">
                            <nav class="mainmenu__nav hidden-xs hidden-sm">
                                <ul class="main__menu">


                                    <?php
                                    $role_id = $this->session->userdata('role_id');
                                    $queryMenu = "SELECT `user_menu`.`id`, `menu`, `url`,`icon`,`is_active`
                                      FROM `user_menu` JOIN `user_access_menu`
                                        ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                                     WHERE `user_access_menu`.`role_id` = $role_id AND `user_menu`.`is_active` = 1
                                     ORDER BY `user_menu`.`menu` ASC
                                     ";
                                     $menu = $this->db->query($queryMenu)->result_array();
                                      ?>

                                    <?php foreach($menu as $m) : ?>

                                    <li class="drop"><a href="<?= base_url($m['url']); ?>"><?= $m['menu'] ?></a></li>

                                    <?php endforeach; ?>

                                </ul>
                            </nav>
                            <div class="mobile-menu clearfix visible-xs visible-sm">
                                <nav id="mobile_dropdown">
                                    <ul>
                                        <?php foreach($menu as $m) : ?>

                                        <li class="drop"><a href="<?= base_url($m['url']); ?>"><?= $m['menu'] ?></a></li>

                                        <?php endforeach; ?>
                                    </ul>
                                </nav>
                            </div>                          
                        </div>
                        <!-- End MAinmenu Ares -->

                        <div class="col-md-2 col-sm-4 col-xs-3">  
                            <ul class="menu-extra">

                                <?php
                                    $role_id = $this->session->userdata('role_id');
                                    $queryMenu2 = "SELECT `user_menu2`.`id`, `menu`, `url`,`icon`,`is_active`
                                      FROM `user_menu2` JOIN `user_access_menu2`
                                        ON `user_menu2`.`id` = `user_access_menu2`.`menu_id`
                                     WHERE `user_access_menu2`.`role_id` = $role_id AND `user_menu2`.`is_active` = 1
                                     ORDER BY `user_access_menu2`.`menu_id` ASC
                                     ";
                                     $menu2 = $this->db->query($queryMenu2)->result_array();
                                      ?>

                                <?php foreach($menu2 as $m2) : ?>

                                <li><a href="<?= base_url($m2['url']); ?>"><span class="<?= $m2['icon']; ?>"></span></a></li>

                                <?php endforeach; ?>

                                <li><span class="ti-shift-right" data-target="#modalaja" data-toggle="modal"></span></li>

                                <li class="toggle__menu hidden-xs hidden-sm"><span class="ti-menu"></span></li>

                            </ul>
                        </div>

                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
            <!-- End Mainmenu Area -->
        </header><br>

        <div class="modal fade" id="modalaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h2>
                Apakah Anda Yakin Ingin Keluar?
                </h2>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a href="<?= base_url('auth/logout'); ?>"><button type="button" class="btn btn-primary">Keluar</button></a>
              </div>
            </div>
          </div>
        </div>

        <div class="body__overlay"></div>
        <!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
            <!-- Start Search Popap -->
            <div class="search__area">
                <div class="container" >
                    <div class="row" >
                        <div class="col-md-12" >
                            <div class="search__inner">
                                <form action="#" method="get">
                                    <input placeholder="Search here... " type="text">
                                    <button type="submit"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Search Popap -->
            <!-- Start Offset MEnu -->
            <div class="offsetmenu">
                <div class="offsetmenu__inner">
                    <div class="offsetmenu__close__btn">
                        <a href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                    <div class="off__contact">
                        <div class="logo">
                            <a href="<?= base_url('user'); ?>">
                                <img src="<?php echo base_url('assets/images/logo/logo2.png');?>" alt="logo">
                            </a>
                        </div>
                        <h1 style="text-align: center;"><strong>Side Menu</strong></h1>
                    </div>
                    <ul>

                        <?php
                        $role_id = $this->session->userdata('role_id');
                        $queryMenu3 = "SELECT `user_menu3`.`id`, `menu`, `url`,`icon`,`is_active`
                        FROM `user_menu3` JOIN `user_access_menu3`
                        ON `user_menu3`.`id` = `user_access_menu3`.`menu_id`
                        WHERE `user_access_menu3`.`role_id` = $role_id AND `user_menu3`.`is_active` = 1
                        ORDER BY `user_access_menu3`.`menu_id` ASC
                        ";
                        $menu3 = $this->db->query($queryMenu3)->result_array();
                        ?>

                        <?php foreach($menu3 as $m3) : ?>

                        <li><h2><a href="<?= base_url($m3['url']); ?>"><span class="<?= $m3['icon']; ?>"> <?= $m3['menu'] ?></span></a></h2></li><br>

                        <?php endforeach; ?>

                        <?php foreach($menu2 as $m2) : ?>

                        <li><h2><a href="<?= base_url($m2['url']); ?>"><span class="<?= $m2['icon']; ?>"> <?= $m2['menu'] ?></span></a></h2></li><br>

                        <?php endforeach; ?>

                        <li><h2><a href="#"><span class="ti-shift-right" data-target="#modalaja1" data-toggle="modal"> Logout</span></h2></a></li>

                        <div class="modal fade" id="modalaja1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <h2>
                                Apakah Anda Yakin Ingin Keluar?
                                </h2>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <a href="<?= base_url('auth/logout'); ?>"><button type="button" class="btn btn-primary">Keluar</button></a>
                              </div>
                            </div>
                          </div>
                        </div>

                    </ul>
                </div>
            </div>

            <div class="shopping__cart">
                <div class="shopping__cart__inner">
                    <div class="offsetmenu__close__btn">
                        <a href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                    <div class="shp__cart__wrap">
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="#">
                                    <img src="images/product/sm-img/1.jpg" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href="product-details.html">BO&Play Wireless Speaker</a></h2>
                                <span class="quantity">QTY: 1</span>
                                <span class="shp__price">$105.00</span>
                            </div>
                            <div class="remove__btn">
                                <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                            </div>
                        </div>
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="#">
                                    <img src="images/product/sm-img/2.jpg" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href="product-details.html">Brone Candle</a></h2>
                                <span class="quantity">QTY: 1</span>
                                <span class="shp__price">$25.00</span>
                            </div>
                            <div class="remove__btn">
                                <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                            </div>
                        </div>
                    </div>
                    <ul class="shoping__total">
                        <li class="subtotal">Subtotal:</li>
                        <li class="total__price">$130.00</li>
                    </ul>
                    <ul class="shopping__btn">
                        <li><a href="cart.html">View Cart</a></li>
                        <li class="shp__checkout"><a href="checkout.html">Checkout</a></li>
                    </ul>
                </div>
            </div>
            
    </div>
    <!-- End Cart Panel -->
    <!-- Body main wrapper end -->
    <!-- QUICKVIEW PRODUCT -->
    <div id="quickview-wrapper">
        <!-- Modal -->
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal__container" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-product">
                            <!-- Start product images -->
                            <div class="product-images">
                                <div class="main-image images">
                                    <img alt="big images" src="images/product/big-img/1.jpg">
                                </div>
                            </div>
                            <!-- end product images -->
                            <div class="product-info">
                                <h1>Simple Fabric Bags</h1>
                                <div class="rating__and__review">
                                    <ul class="rating">
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                    </ul>
                                    <div class="review">
                                        <a href="#">4 customer reviews</a>
                                    </div>
                                </div>
                                <div class="price-box-3">
                                    <div class="s-price-box">
                                        <span class="new-price">$17.20</span>
                                        <span class="old-price">$45.00</span>
                                    </div>
                                </div>
                                <div class="quick-desc">
                                    Designed for simplicity and made from high quality materials. Its sleek geometry and material combinations creates a modern look.
                                </div>
                                <div class="select__color">
                                    <h2>Select color</h2>
                                    <ul class="color__list">
                                        <li class="red"><a title="Red" href="#">Red</a></li>
                                        <li class="gold"><a title="Gold" href="#">Gold</a></li>
                                        <li class="orange"><a title="Orange" href="#">Orange</a></li>
                                        <li class="orange"><a title="Orange" href="#">Orange</a></li>
                                    </ul>
                                </div>
                                <div class="select__size">
                                    <h2>Select size</h2>
                                    <ul class="color__list">
                                        <li class="l__size"><a title="L" href="#">L</a></li>
                                        <li class="m__size"><a title="M" href="#">M</a></li>
                                        <li class="s__size"><a title="S" href="#">S</a></li>
                                        <li class="xl__size"><a title="XL" href="#">XL</a></li>
                                        <li class="xxl__size"><a title="XXL" href="#">XXL</a></li>
                                    </ul>
                                </div>
                                <div class="social-sharing">
                                    <div class="widget widget_socialsharing_widget">
                                        <h3 class="widget-title-modal">Share this product</h3>
                                        <ul class="social-icons">
                                            <li><a target="_blank" title="rss" href="#" class="rss social-icon"><i class="zmdi zmdi-rss"></i></a></li>
                                            <li><a target="_blank" title="Linkedin" href="#" class="linkedin social-icon"><i class="zmdi zmdi-linkedin"></i></a></li>
                                            <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
                                            <li><a target="_blank" title="Tumblr" href="#" class="tumblr social-icon"><i class="zmdi zmdi-tumblr"></i></a></li>
                                            <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="addtocart-btn">
                                    <a href="#">Add to cart</a>
                                </div>
                            </div><!-- .product-info -->
                        </div><!-- .modal-product -->
                    </div><!-- .modal-body -->
                </div><!-- .modal-content -->
            </div><!-- .modal-dialog -->
        </div>
        <!-- END Modal -->
    </div>