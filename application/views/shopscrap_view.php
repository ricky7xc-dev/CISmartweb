<?php  
require('scrap.php');
 ?>

    <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(<?php echo base_url('assets/img/cabean.jpg');?>) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title" style="color: white;">Shop Page</h2>
                                <nav class="bradcaump-inner">
                                  <a  style="color: white;" class="breadcrumb-item" href="index.html">Home</a>
                                  <span style="color: white;" class="brd-separetor">/</span>
                                  <span class="breadcrumb-item active" style="color: white;">Shop Page</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header gambar -->
        
        <section class="htc__product__area shop__page ptb--130 bg__white"><!-- Section -->
            <div class="container"><!-- container awal -->
                <div class="htc__product__container"><!-- product container -->
                    
                    <!-- Filter -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="filter__menu__container">
                                <div class="product__menu">
                                    <button data-filter="*"  class="is-checked">All</button>
                                    <button data-filter=".cat--1">Action</button>
                                    <button data-filter=".cat--2">Bibit Online</button>
                                    <button data-filter=".cat--3">Sentratani</button>
                                    <button data-filter=".cat--4">Cari Sayur</button>
                                    <button data-filter=".cat--5">Primatani</button>
                                    <button data-filter=".cat--6">Purotani</button>
                                    <button data-filter=".cat--7">Top E-Commerce</button>
                                    <button data-filter=".cat--8">Indomaret</button>
                                    <button data-filter=".cat--9">Bibit Bunga</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Filter -->


                    <div class="row"><!-- row product list -->
                        <div class="product__list another-product-style"><!-- product list -->

                            <!-- kat1 --><?php foreach ($products1 as $product) : ?><!-- Agromaret cabe merah 1 -->
                            <div class="col-md-3 single__pro col-lg-3 * col-sm-4 col-xs-12">
                                <div class="product foo">
                                    <div class="product__inner">
                                        <div class="pro__thumb">
                                                <a href="<?= $product['link'] ?>"><img style="width: 100%" src="<?= $product['img'] ?>" alt="product images"></a>
                                        </div>
                                    </div>
                                    <div class="product__details">
                                        <h2><a href="<?= $product['link'] ?>"><?= $product['title'] ?></a></h2>
                                        <h2><?= $product['rating'] ?></h2>
                                        <h2><?= $product['release'] ?></h2>
                                        <a href="<?= $product['link'] ?>"><button class="btn btn-info">Kunjungi link</button></a>
                                    </div>
                                </div>
                            </div>
                            <!-- kat1 --><?php endforeach; ?>

                            <!-- kat1 --><?php foreach ($products3 as $product) : ?><!-- Agromaret cabe merah 1 -->
                                <div class="col-md-3 single__pro col-lg-3 cat--1 col-sm-4 col-xs-12">
                                <div class="product foo">
                                    <div class="product__inner">
                                        <div class="pro__thumb">
                                                <a href="<?= $product['link'] ?>"><img style="width: 100%" src="<?= $product['img'] ?>" alt="product images"></a>
                                        </div>
                                    </div>
                                    <div class="product__details">
                                        <h2><a href="<?= $product['link'] ?>"><?= $product['title'] ?></a></h2>
                                        <h2><?= $product['rating'] ?></h2>
                                        <h2><?= $product['release'] ?></h2>
                                        <a href="<?= $product['link'] ?>"><button class="btn btn-info">Kunjungi link</button></a>
                                    </div>
                                </div>
                            </div>
                            <!-- kat1 --><?php endforeach; ?>

                        </div><!-- product list -->
                    </div><!-- row product list -->

                </div><!-- product container -->
            </div><!-- container awal -->
        </section><!-- Section -->